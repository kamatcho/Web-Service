//
//  Add+TaskVc.swift
//  WebService
//
//  Created by MOHAMED on 2/13/17.
//  Copyright © 2017 MOHAMED. All rights reserved.
//

import UIKit
import Alamofire
import SwiftyJSON
class Add_TaskVc: UIViewController {

    @IBOutlet weak var TaskDescriptionTxt: UITextField!
    @IBOutlet weak var TaskTitleTxt: UITextField!
    override func viewDidLoad() {
        super.viewDidLoad()

        // Do any additional setup after loading the view.
    }

    
    @IBAction func AddTaskBu(_ sender: Any) {
        guard let task = self.TaskTitleTxt.text , !task.isEmpty else {return}
        guard let details = self.TaskDescriptionTxt.text , !details.isEmpty else {return}
        ApiMethods.addTask(task: task, details: details) { (error: Error?, task :[Task]?) in
            self.TaskDescriptionTxt.text = ""
            self.TaskTitleTxt.text = ""
        }
    }
}
