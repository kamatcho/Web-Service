//
//  TasksVc.swift
//  WebService
//
//  Created by MOHAMED on 2/11/17.
//  Copyright © 2017 MOHAMED. All rights reserved.
//

import UIKit
import Alamofire
import SwiftyJSON
class TasksVc: UIViewController,UITableViewDelegate, UITableViewDataSource {

    @IBOutlet weak var taskTableView: UITableView!
    var tasks = [Task]()
    lazy var refresher : UIRefreshControl = {
        let refresher = UIRefreshControl()
        refresher.addTarget(self, action: #selector(handelRefresh), for: .valueChanged)
        return refresher
    }()
    
    var current_page :Int = 1
    var last_page : Int = 1
    var isLoading : Bool = false
    
    override func viewDidLoad() {
        super.viewDidLoad()
        taskTableView.tableFooterView = UIView()
        taskTableView.separatorInset = .zero
        taskTableView.contentInset = .zero
        taskTableView.delegate = self
        taskTableView.dataSource = self
        taskTableView.addSubview(refresher)
        
       handelRefresh()

        
        
        print(tasks.count)

        // Do any additional setup after loading the view.
    }
    override func viewWillAppear(_ animated: Bool) {
        super.viewWillAppear(true)
        handelRefresh()

    }
   
    
    func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return tasks.count
    }
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let cell = taskTableView.dequeueReusableCell(withIdentifier: "TasksCell") as! TaskCell
        let task = tasks[indexPath.row]
       cell.ConfigureCell(task: task)
        return cell
    }
    
     @objc private func handelRefresh() {
        self.refresher.endRefreshing()
        guard !isLoading else {return}
        isLoading = true
        ApiMethods.getTasks { (error : Error?, tasks :[Task]?, last_page : Int) in
            self.isLoading = false
            if let tasks = tasks {
                self.tasks = tasks
                self.taskTableView.reloadData()
                self.current_page = 1
                self.last_page = last_page
            }
        }
    }
   
    func loadMore ()  {
        
        guard !isLoading else {return}
        guard current_page < last_page else {return}
        isLoading = true
        ApiMethods.getTasks(page: current_page+1) { (error : Error?, tasks :[Task]?, last_page : Int) in
            self.isLoading = false
            if let tasks = tasks {
                self.tasks.append(contentsOf: tasks)
                self.taskTableView.reloadData()
                print(tasks.count)
                self.current_page += 1
                self.last_page = last_page
            }
        }
        
    }

    func tableView(_ tableView: UITableView, willDisplay cell: UITableViewCell, forRowAt indexPath: IndexPath) {
        let count = self.tasks.count
        if indexPath.row == count-1 {
            self.loadMore()
        }
    }
 
    func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        performSegue(withIdentifier: "SingleTask", sender: tasks[indexPath.row])
    }
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
        if let dist = segue.destination as? Edit_Task {
            if let Item = sender as? Task {
                dist.TaskItem = Item
            }
            
        }
            
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
  
}
