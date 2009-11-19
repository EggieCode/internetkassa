    	require_once(JPATH_COMPONENT . DS . 'libraries' . DS . 'internetkassa' . DS . 'feedback.php');
    	$feedback = new IK_feedback();
    	$feedback->bind($_REQUEST);
    	
    	if ($feedback->error_code != 0 || $feedback->status != 5) {
    		//Er ging iets fout
    		return;
    	}