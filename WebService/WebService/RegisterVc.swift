//
//  RegisterVc.swift
//  WebService
//
//  Created by MOHAMED on 2/11/17.
//  Copyright © 2017 MOHAMED. All rights reserved.
//

import UIKit
import Alamofire
import SwiftyJSON
class RegisterVc: UIViewController {

    @IBOutlet weak var ConfirmTxt: UITextField!
    @IBOutlet weak var EmailTxt: UITextField!
    @IBOutlet weak var PasswordTxt: UITextField!
    @IBOutlet weak var UserNameTxt: UITextField!
    override func viewDidLoad() {
        super.viewDidLoad()

        // Do any additional setup after loading the view.
    }


    @IBAction func RegisterBu(_ sender: Any) {
        
        let url = URL(string: RegisterUrl)!
        guard let username = UserNameTxt.text , !username.isEmpty else {return}
        guard let email = EmailTxt.text , !email.isEmpty else {return}
        guard let password = PasswordTxt.text , !password.isEmpty else {return}
        guard let confirm = ConfirmTxt.text , !confirm.isEmpty else {return}
        guard password == confirm else {return}
        let parameters = [
            "email" :email,
            "password" : password ,
            "name" : username
        ]
        Alamofire.request(url, method: .post, parameters: parameters, encoding: URLEncoding.default, headers: nil).responseJSON { response in
            switch response.result {
            case .failure(let error) :
                print(error)
            case.success(let value) :
                let json = JSON(value)
                print(json)
                break
            }
        }
    }
}
