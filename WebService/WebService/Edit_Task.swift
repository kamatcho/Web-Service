//
//  Edit_Task.swift
//  WebService
//
//  Created by MOHAMED on 2/13/17.
//  Copyright © 2017 MOHAMED. All rights reserved.
//

import UIKit
import Alamofire
import SwiftyJSON
class Edit_Task: UIViewController , UINavigationControllerDelegate  {

    var TaskItem : Task?
    @IBOutlet weak var TaskDesc: UITextField!
    @IBOutlet weak var TaskTitle: UITextField!
    @IBOutlet weak var TaskName: UILabel!
    lazy var DeleteButton : UIBarButtonItem = {
        let DeleteButton = UIBarButtonItem(barButtonSystemItem: .trash, target: self, action: #selector(DeleteTask))
        return DeleteButton
    }()
    override func viewDidLoad() {
        super.viewDidLoad()
        SetItems(task: TaskItem)
        navigationItem.rightBarButtonItem = DeleteButton

    }
    // Delete Task
    func DeleteTask() {
        let url = URL(string: RemoveTask)!
        guard let api_oken = ApiToken.getApiToken() else {return}
        guard let  task_id = TaskItem?.TaskId else {return}
        let parameters = [
        
            "api_token" : api_oken,
            "id" : task_id
        ] as [String : Any]
        Alamofire.request(url, method: .post, parameters: parameters, encoding: URLEncoding.default, headers: nil).responseJSON { response in
            
            switch response.result {
                
            case .failure(let error) :
                print(error)
                
            case .success(let value):
                let json = JSON(value)
                print(json)
                self.navigationController?.popViewController(animated: true);

                
            }
            
        }
        
        
    }
    // Set Labels
    func SetItems(task : Task?){
        TaskTitle.text = TaskItem?.taskTitle
        TaskDesc.text = TaskItem?.taskDescription
        TaskName.text = TaskItem?.taskTitle
    }
    
    
    
    @IBAction func EditBu(_ sender: Any) {
        guard let taskName = TaskTitle.text , !taskName.isEmpty else {return}
        guard let taskDesc = TaskDesc.text , !taskDesc.isEmpty else {return}
        let taskid = TaskItem?.TaskId
        ApiMethods.editTask(title: taskName, details: taskDesc, id: taskid!) { (error: Error?, task :[Task]?) in
           
        }

    }
    
}
