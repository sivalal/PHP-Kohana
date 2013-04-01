 /* ====================================================================================
      ===================Land the user to his HOME PAGE  Push notifications================
      ===================================================================================== */

    public function action_index() {
        $this->template->content = View::factory('manageuser/push')->bind('results2', $results2)->bind('errors', $errors)->bind('status', $status);

        
         $this->template->head_line = 'Manage Users';
        
        $user_id = Auth::instance()->get_user()->pk();
        $status='';
        
        if ($this->request->post()) {
            $notification_msg = $this->request->post('description');

            $device_palatform = $this->request->post('platform');

            $top = $this->request->post('top');

            $this->processPushmessages($notification_msg, $device_palatform, $top);
            
            if(!file_exists(DOCROOT . 'license/apns-dev-'.$user_id.'.pem'))   
              {
                $status = 'failed';
              }
            
            
        }
        $results2 = DB::select()->from('user_notifications')->where('app_userid', '=', $user_id)->execute();
    }
