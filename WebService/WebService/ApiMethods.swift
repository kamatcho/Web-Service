//
//  ApiMethods.swift
//  WebService
//
//  Created by MOHAMED on 2/16/17.
//  Copyright © 2017 MOHAMED. All rights reserved.
//

import UIKit
import Alamofire
import SwiftyJSON

class ApiMethods {
    
    // Get All Tasks
    class func getTasks(page : Int = 1,compltion : @escaping (_ error:Error?,_ tasks: [Task]? , _ last_page : Int)->Void) {
        let url = URL(string: TaskUrl)!
        print(url)
        
        if  let api_token = ApiToken.getApiToken(){
            let parameters = [
                "api_token" :api_token,
                "page" : page
            ] as [String : Any]
            Alamofire.request(url, method: .get, parameters: parameters, encoding: URLEncoding.default, headers: nil).responseJSON { response in
                switch response.result {
                case.failure(let error) :
                    compltion(error, nil, page)
                    print(error)
                case.success(let value):
                    let json = JSON(value)
                    var tasks = [Task]()
                    if let data = json["data"].array {
                        for obj in data {
                            if let obj = obj.dictionary {
                                let task = Task(TaskDict: obj)
                                tasks.append(task)
                            }
                        }
                    }
                    
                    
                    let last_page = json["last_page"].int ?? page
                    compltion(nil, tasks, last_page)
                    break
                }
                
            }
            
        }

    }
    // End Of Getting All Tasks
    // Add Task
    
    class func addTask(task : String , details :String, complition : @escaping (_ error : Error? , _ newtask :[Task]?)->Void) {
        if let api_token = ApiToken.getApiToken() {
            let url = URL(string: AddTask)!
        
            
            let parameters = [
                "name" : task ,
                "description" : details,
                "api_token" : api_token
            ]
            
            Alamofire.request(url, method: .post, parameters: parameters, encoding: URLEncoding.default, headers: nil).responseJSON { response in
                switch response.result {
                    
                case .failure(let error) :
                    complition(error, nil)
                    print(error)
                case .success(let value):
                    print(value)
                complition(nil ,nil)
                    break
                }
                
            }
            
        }else {
            ApiToken.restartApp()
        }
        
        
    }
    
    // Edit Task 
    
    class func editTask(title : String , details : String , id : Int , complition : @escaping (_ error : Error? ,_ editedtask : [Task]?)->Void){
        let url = URL(string: EditTask)!
        if let api_token = ApiToken.getApiToken() {
          
            let parameters = [
                "api_token" : api_token,
                "name" : title,
                "description" : details,
                "id" : id
                ] as [String : Any]
            Alamofire.request(url, method: .post, parameters: parameters, encoding: URLEncoding.default, headers: nil).responseJSON(completionHandler: { response in
                switch response.result {
                case.failure(let error):
                    complition(error, nil)
                    print(error)
                case .success(let value):
                    complition(nil, nil)
                    print(value)
                    break
                }
            })
            
        }
        

        
    }
    
    // Delete Task 
    
    
    
    
    
}
