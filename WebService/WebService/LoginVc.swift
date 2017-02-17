//
//  LoginVc.swift
//  WebService
//
//  Created by MOHAMED on 2/11/17.
//  Copyright © 2017 MOHAMED. All rights reserved.
//

import UIKit
import Alamofire
import SwiftyJSON
class LoginVc: UIViewController {

    @IBOutlet weak var PasswordTxt: UITextField!
    @IBOutlet weak var EmailTxt: UITextField!
    override func viewDidLoad() {
        super.viewDidLoad()
        // Do any additional setup after loading the view, typically from a nib.
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }


    //Login Action
    @IBAction func SignInBut(_ sender: Any) {
        let url = URL(string: LoginUrl)!
        guard let email = EmailTxt.text , !email.isEmpty else {return}
        guard let password = PasswordTxt.text , !password.isEmpty else {return}
        let parameters = [
            "email" : email,
            "password" : password
        ]
        Alamofire.request(url, method: .post, parameters: parameters, encoding: URLEncoding.default, headers: nil).responseJSON { response in
            switch response.result {
            case .failure(let error):
                print(error)
            case .success(let value):
                let json = JSON(value)
                let data = json["data"]
                if  let api_token = data["api_token"].string {
                    ApiToken.setApiToken(Token: api_token)
                }
               
            break
            }
        }
  
    }
    // End Of Login Action
}

