//
//  ImagesVc.swift
//  WebService
//
//  Created by MOHAMED on 2/16/17.
//  Copyright © 2017 MOHAMED. All rights reserved.
//

import UIKit

class ImagesVc: UIViewController, UICollectionViewDelegateFlowLayout, UICollectionViewDataSource, UINavigationControllerDelegate, UIImagePickerControllerDelegate {

    @IBOutlet weak var ImageCollctionView: UICollectionView!
    
    // Button For Adding Image
    lazy var AddButton : UIBarButtonItem = {
        let AddButton = UIBarButtonItem(barButtonSystemItem: .add, target: self, action: #selector(AddImage))
        return AddButton
    }()
    
/// Refresh Collection View
    lazy var refresher : UIRefreshControl = {
        let refresher = UIRefreshControl()
        refresher.addTarget(self, action: #selector(handelRefresh), for: .valueChanged)
        return refresher
    }()
    
    var Photo = [Image]()
    
    var current_page :Int = 1
    var last_page : Int = 1
    var isLoading : Bool = false
    
    
    override func viewDidLoad() {
        super.viewDidLoad()
        ImageCollctionView.delegate = self
        ImageCollctionView.dataSource = self
       navigationItem.rightBarButtonItem = AddButton
        ImageCollctionView.register(UINib.init(nibName: "ImageCell", bundle: nil), forCellWithReuseIdentifier: "ImageCell")
        // Do any additional setup after loading the view.
        ImageCollctionView.addSubview(refresher)
        handelRefresh()
    }
    
   
    @objc private func handelRefresh() {
        self.refresher.endRefreshing()
        guard !isLoading else {return}
        isLoading = true
        ApiMethods.DownloadImage { (error : Error?, photos :[Image]?, last_page : Int) in
            self.isLoading = false
            if let photos = photos {
                self.Photo = photos
                self.ImageCollctionView.reloadData()
                self.current_page = 1
                self.last_page = last_page
            }
        }
    }
    
    func loadMore ()  {
        
        guard !isLoading else {return}
        guard current_page < last_page else {return}
        isLoading = true
        ApiMethods.DownloadImage(page: current_page+1) { (error : Error?, photos :[Image]?, last_page : Int) in
            self.isLoading = false
            if let photos = photos {
                self.Photo = photos
                self.ImageCollctionView.reloadData()
                print(photos.count)
                self.current_page += 1
                self.last_page = last_page
            }
        }
        
    }
    override func viewDidAppear(_ animated: Bool) {
        super.viewDidAppear(true)
        handelRefresh()
    }
    
    // Add Image To Server
    var pick_image : UIImage? {
        didSet {
            guard let image = pick_image else {return}
            ApiMethods.UpdloadImage(Photo: image)
            
        }
    }
    // Add Image With Photo Library
     @objc fileprivate func AddImage() {
        let picker = UIImagePickerController()
        picker.allowsEditing = true
        picker.sourceType = .photoLibrary
        picker.delegate = self
        self.present(picker, animated: true, completion: nil)
        
    }
    // Cancel Image Picking
    func imagePickerControllerDidCancel(_ picker: UIImagePickerController) {
        self.dismiss(animated: true, completion: nil)
    }
    // Pick Image
    func imagePickerController(_ picker: UIImagePickerController, didFinishPickingMediaWithInfo info: [String : Any]) {
        if  let edited_image = info[UIImagePickerControllerEditedImage] as? UIImage{
            self.pick_image = edited_image
        }else if let original_image = info[UIImagePickerControllerOriginalImage] as? UIImage {
            self.pick_image = original_image
        }
        picker.dismiss(animated: true, completion: nil)
    }
    /// Number Of Items
    func collectionView(_ collectionView: UICollectionView, numberOfItemsInSection section: Int) -> Int {
        return Photo.count
    }
    // Cell For Item
    func collectionView(_ collectionView: UICollectionView, cellForItemAt indexPath: IndexPath) -> UICollectionViewCell {
        guard let cell = collectionView.dequeueReusableCell(withReuseIdentifier: "ImageCell", for: indexPath) as? ImageCell else {return UICollectionViewCell()}
        let photo = Photo[indexPath.item]
        cell.ConfigureImageCell(photo: photo)
        return cell
        
    }
    // Custimize Cell Size
    
    func collectionView(_ collectionView: UICollectionView, layout collectionViewLayout: UICollectionViewLayout, sizeForItemAt indexPath: IndexPath) -> CGSize {
        let screenWidth = UIScreen.main.bounds.width
        
        var width = (screenWidth - 30) / 2
        
        if width > 200 {
            width = 200
        }
        return CGSize(width: width, height: width)
    }
}
