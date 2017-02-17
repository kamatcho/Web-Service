//
//  Image.swift
//  WebService
//
//  Created by MOHAMED on 2/16/17.
//  Copyright © 2017 MOHAMED. All rights reserved.
//

import UIKit

import SwiftyJSON
class Image {
    
    var photo : String!
    
    init(dict : [String:JSON]) {
        if let image = dict["image"]?.string {
            self.photo = FileRoote + image
        }

    }
}
