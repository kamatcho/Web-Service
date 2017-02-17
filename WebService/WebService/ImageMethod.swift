//
//  ImageMethod.swift
//  WebService
//
//  Created by MOHAMED on 2/16/17.
//  Copyright © 2017 MOHAMED. All rights reserved.
//

import UIKit
import Alamofire
import SwiftyJSON

extension ApiMethods {
    
    // Upload Image
    class func UpdloadImage(Photo :UIImage){
        guard let api_token = ApiToken.getApiToken() else {return}
        let url = URL(string: AddImageUrl+"?api_token=\(api_token)")!
        
        Alamofire.upload(multipartFormData: { (form :MultipartFormData) in
            if let data = UIImageJPEGRepresentation(Photo , 0.5) {
                form.append(data, withName: "image", fileName: "image.jpeg", mimeType: "image/jpeg")
            }
        }, usingThreshold: SessionManager.multipartFormDataEncodingMemoryThreshold, to: url, method: .post, headers: nil) { (result : SessionManager.MultipartFormDataEncodingResult) in
            switch result {
            case .failure(let error):
                print(error)
            case.success(request: let upload, streamingFromDisk: _, streamFileURL: _):
                upload.uploadProgress(closure: { (progress) in
                    print(progress)
                }).responseJSON(completionHandler: { (response :DataResponse<Any>) in
                    switch response.result {
                    case .failure(let error):
                        print(error)
                    case.success(let value):
                        let json = JSON(value)
                        print(json)
                        
                    }
                })
                break
                
            }
            
        }

    }
    
    // Download Image 
    class func DownloadImage (page : Int = 1,compltion : @escaping (_ error:Error?,_ photos: [Image]? , _ last_page : Int)->Void) {
        guard let api_token = ApiToken.getApiToken() else {return}
        
        let url = URL(string: UserImage+"?api_token=\(api_token)")!
        print("Url :- \(url)")
        
        Alamofire.request(url, method: .get, parameters: nil, encoding: URLEncoding.default, headers: nil).responseJSON { response in
            switch response.result {
            case .failure(let error):
                compltion(error, nil, page)
                print(error)
            case.success(let value):
                let json = JSON(value)
                var Photos = [Image]()
                if let dataArr = json["data"].array{
                    for obj in dataArr {
                        if let obj = obj.dictionary {
                            let photo = Image(dict: obj)
                            Photos.append(photo)
                        }
                    }
                    
                }
                let last_page = json["last_page"].int ?? page
                compltion(nil, Photos, last_page)
                
                break
                
            }
        }

    }
}
