//
//  TaskCell.swift
//  WebService
//
//  Created by MOHAMED on 2/11/17.
//  Copyright © 2017 MOHAMED. All rights reserved.
//

import UIKit

class TaskCell: UITableViewCell {

    @IBOutlet weak var CellView: UIView!
    @IBOutlet weak var TaskDetailsTxt: UILabel!
    
    @IBOutlet weak var Tasktxt: UILabel!
    
    func ConfigureCell(task : Task){
         TaskDetailsTxt.text = task.taskTitle
        Tasktxt.text = task.taskDescription
       

    

    }
}
