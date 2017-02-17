//
//  Task.swift
//  WebService
//
//  Created by MOHAMED on 2/11/17.
//  Copyright © 2017 MOHAMED. All rights reserved.
//

import UIKit
import Alamofire
import SwiftyJSON
class Task {
    var taskTitle : String!
    var taskDescription : String!
    var TaskId : Int!
    

    init(TaskDict : [String:JSON]) {
        if let title = TaskDict["task"]?.string {
         taskTitle = title
           
        }
        if let details = TaskDict["description"]?.string {
            taskDescription = details
        }
        if let taskId = TaskDict["id"]?.int {
            TaskId = taskId
        }
    }
}




