//
//  ImageCell.swift
//  WebService
//
//  Created by MOHAMED on 2/16/17.
//  Copyright © 2017 MOHAMED. All rights reserved.
//

import UIKit
import Kingfisher
class ImageCell: UICollectionViewCell {

   
    @IBOutlet weak var UserImage: UIImageView!

    func ConfigureImageCell(photo : Image) {
        let url = URL(string: photo.photo)!
        UserImage.kf.setImage(with: url, placeholder: nil, options: [.transition(ImageTransition.flipFromLeft(0.5))], progressBlock: nil, completionHandler: nil)
    }
}
