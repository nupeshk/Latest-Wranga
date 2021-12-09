<?php

$config = array(

    'api/v1/login' => array(
        array(
            'field' => 'email',
            'label' => 'email',
            'rules' => 'trim|required|valid_email',
            'errors' => array(
                'required' => '%s should not be blank.',
            ),
        ),

        array(
            'field' => 'password',
            'label' => 'password',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => '%s should not be blank.',
            ),
        ),
    ),


    'api/v1/like' => array(
        array(
            'field' => 'commentId',
            'label' => 'commentId',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => '%s should not be blank.',
            ),
        ),
        array(
            'field' => 'userId',
            'label' => 'userId',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => '%s should not be blank.',
            ),
        ),
    ),

    'api/v1/login2' => array(
        array(
            'field' => 'email',
            'label' => 'email',
            'rules' => 'trim|required|valid_email',
            'errors' => array(
                'required' => '%s should not be blank.',
            ),
        ),
    ),

    'api/v1/comment' => array(
        array(
            'field' => 'contentId',
            'label' => 'contentId',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => '%s should not be blank.',
            ),
        ),
       array(
            'field' => 'commentRating',
            'label' => 'commentRating',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => '%s should not be blank.',
            ),
        ),
    ),


        'api/v1/commentList' => array(
        array(
            'field' => 'contentId',
            'label' => 'contentId',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => '%s should not be blank.',
            ),
        ),
        array(
            'field' => 'userId',
            'label' => 'userId',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => '%s should not be blank.',
            ),
        ),
    
    ),


    'api/v1/commentReply' => array(
        array(
            'field' => 'commentId',
            'label' => 'commentId',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => '%s should not be blank.',
            ),
        ),
        array(
            'field' => 'userId',
            'label' => 'userId',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => '%s should not be blank.',
            ),
        ),
        /*array(
            'field' => 'comment',
            'label' => 'comment',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => '%s should not be blank.',
            ),
        ),*/
    ),




    'api/v1/signup2' => array(
      array(
          'field' => 'email',
          'label' => 'email',
            'rules' => 'trim|required|valid_email',
          'errors' => array(
             'required' => '%s should not be blank.',
          ),
      ),
      array(
          'field' => 'socialid',
          'label' => 'socialid',
            'rules' => 'trim|required',
          'errors' => array(
             'required' => '%s should not be blank.',
          ),
      ),
    ),


     'api/v1/signup' => array(
        array(
          'field' => 'name',
          'label' => 'name',
          'rules' => 'trim|required',
          'errors' => array(
             'required' => '%s should not be blank.',
          ),
      ),
      array(
          'field' => 'email',
          'label' => 'email',
            'rules' => 'trim|required|valid_email',
          'errors' => array(
             'required' => '%s should not be blank.',
          ),
      ),
      array(
          'field' => 'password',
          'label' => 'password',
          'rules' => 'trim|required',
          'errors' => array(
             'required' => '%s should not be blank.',
          ),
      ),
      array(
          'field' => 'socialid',
          'label' => 'socialid',
          'rules' => 'trim|required',
          'errors' => array(
             'required' => '%s should not be blank.',
          ),
      ), 
    ),



     'api/v1/forget' => array(
        array(
            'field' => 'email',
            'label' => 'email',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => '%s should not be blank.',
            ),
        ), 
    ),





    'api/v1/search' => array(
        array(
            'field' => 'search',
            'label' => 'search',
            'rules' => 'trim|required',
            'errors' => array(
            'required' => '%s should not be blank.',
            ),
        ), 
    ), 




    'api/v1/viewAll' => array(
        array(
            'field' => 'catgId',
            'label' => 'catgId',
            'rules' => 'trim|required',
            'errors' => array(
            'required' => '%s should not be blank.',
            ),
        ),
        array(
            'field' => 'sub_catgId',
            'label' => 'sub_catgId',
            'rules' => 'trim|required',
            'errors' => array(
            'required' => '%s should not be blank.',
            ),
        ), 
    ),
    
    'api/v1/ottTypeviewAll' => array(
        array(
            'field' => 'ottPlaformType',
            'label' => 'ottPlaformType',
            'rules' => 'trim|required',
            'errors' => array(
            'required' => '%s should not be blank.',
            ),
        ),
    ), 
     

    'api/verifyOtp' => array(
        array(
            'field' => 'mobileNo',
            'label' => 'mobileNo',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => '%s should not be blank.',
            ),
        ),
        array(
          'field' => 'otp',
          'label' => 'otp',
          'rules' => 'trim|required',
          'errors' => array(
             'required' => '%s should not be blank.',
          ),
        ),
    ),

    

    'api/suggested' => array(
        array(
            'field' => 'contentId',
            'label' => 'contentId',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => '%s should not be blank.',
            ),
        ),
    ), 

    'api/addContact' => array(
        array(
            'field' => 'name',
            'label' => 'name',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => '%s should not be blank.',
            ),
        ),
        array(
            'field' => 'mobileNumber',
            'label' => 'mobileNumber',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => '%s should not be blank.',
            ),
        ),
    ),


    ///admin validation

    'admin/login' => array(

        array(

            'field' => 'administratorEmail',

            'label' => 'Email',

            'rules' => 'trim|required|valid_email',

            'errors' => array(

                'required' => '%s should not be blank.',

                'valid_email' => '%s should be valid.',

            ),

        ),

        array(

            'field' => 'administratorPassword',

            'label' => 'Password',

            'rules' => 'trim|required',

            'errors' => array(

                'required' => '%s should not be blank.',

            ),

        ),

    ),

   

 

 


    'admin/users/notification' => array(

        array(

            'field' => 'users[]',

            'label' => 'User',

            'rules' => 'trim|required',

            'errors' => array(

                'required' => '%s should not be blank.',

            ),

        ),

        array(

            'field' => 'message',

            'label' => 'Message',

            'rules' => 'trim|required',

            'errors' => array(

                'required' => '%s should not be blank.',

            ),

        ),

    ),

);

?>