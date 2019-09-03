<?php
namespace App\Controller;

use App\Model\UzduotisModel;
use App\Helper\FormHelper;
use Core\Controller;


class UzduotisController extends Controller
{

    //require_once('../scripts/lcoa.php');

    public function index()
    {
        $this->view->render('uzduotis/uzduotis');
    }

    public function create()
    {
        $form = new FormHelper(url('uzduotis/store'), 'post', 'wrapper', 'enctype="multipart/form-data"');
        $form->addInput([
            'name' => 'name',
            'type' => 'text',
            'placeholder' => 'Name',
            'required' => 'required'
        ], '', 'input')
            ->addInput([
                'name' => 'email',
                'type' => 'text',
                'placeholder' => 'Email',
                'required' => 'required'
            ])
            ->addInput([
                'name' => 'phone',
                'type' => 'number',
                'placeholder' => 'Phone',
                'required' => 'required'
            ])
            ->addInput([
                'name' => 'jobid',
                'type' => 'text',
                'placeholder' => 'Job ID',
                'required' => 'required'
            ])
            ->addInput([
                'name' => 'jobtitle',
                'type' => 'text',
                'placeholder' => 'Job Title',
                'required' => 'required'
            ])
            ->addTextarea([
                'name' => 'coverletter',
                'placeholder' => 'Coverletter',
                'required' => 'required'
            ], 'coverletter', '', '', 'Coverletter')
            ->addInput([
                'name' => 'resume',
                'type' => 'file',
                'placeholder' => 'Add resume',
                'required' => 'required'
            ])
        ->addInput([
                'name' => 'registrate',
                'type' => 'submit',
                'value' => 'submit',
            ], '', '');
        $this->view->form = $form->get();
        $this->view->render('uzduotis/uzduotis');
    }


    public function store()
    {
        $uzduotisModel = new UzduotisModel();
        $uzduotisModel->setName($_POST['name']);
        $uzduotisModel->setEmail($_POST['email']);
        $uzduotisModel->setPhone($_POST['phone']);
        $uzduotisModel->setJobid($_POST['jobid']);
        $uzduotisModel->setJobtitle($_POST['jobtitle']);
        $uzduotisModel->setCover($_POST['coverletter']);
        $uzduotisModel->setResume($_FILES['resume']['name']);
        $uzduotisModel->save();
        $this->send();

    }

    public function send()
    {
        $timestamp = time();
        $folder = "/var/www/html/php2/mvc/uploads/careers/resumes/";
        //$resume = ($_FILES['resume']['name']);
        $target = $folder.basename($timestamp.$_FILES['resume']['name']);

        $sendto   = "erikamik666@yahoo.com";
        $name  = nl2br($_POST['name']);
        $email  = nl2br($_POST['email']);
        $phone  = nl2br($_POST['phone']);
        $jobid = nl2br($_POST['jobid']);
        $jobtitle = nl2br($_POST['jobtitle']);
        $cover = nl2br($_POST['coverletter']);
        $subject = "Submitted Job Application";
        $headers = "Content-Type: text/html;charset=utf-8 \r\n";
        $headers .= "From: " . strip_tags($email) . "\r\n";
        $headers .= "Reply-To: ". strip_tags($email) . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html;charset=utf-8 \r\n";
        $msg  = "<html><body style='font-family:Arial,sans-serif;'>";
        $msg .= "<h2 style='font-weight:bold;border-bottom:1px dotted #ccc;'>Job Application Submitted</h2>\r\n";
        $msg .= "<p><strong>Applied for:</strong> ".$jobtitle."</p>\r\n";
        $msg .= "<p><strong>Job ID:</strong> ".$jobid."</p>\r\n";
        $msg .= "<p><strong>Applicant Name:</strong> ".$name."</p>\r\n";
        $msg .= "<p><strong>Email:</strong> ".$email."</p>\r\n";
        $msg .= "<p><strong>Phone:</strong> ".$phone."</p>\r\n";
        $msg .= "<p><strong>Cover Letter:</strong> ".$cover."</p>\r\n";
        $msg .= "<a href='http://domain.com/".$target."'>Download Resume</a>\r\n";
        $msg .= "</body></html>";
        if(@mail($sendto, $subject, $msg, $headers)) {
            echo "";
        } else {
            echo "false";
        }

        $emailSent = mail($sendto, $subject, $msg, $headers);

        if( $emailSent == true ) {
            echo "<div id='confirm-app'><p>Thank you for submitting your application.  Resumes submitted will be reviewed to determine qualifications that match our hiring needs.<br /><br />  If you are selected you will be contacted by a member of our recruiting team.</p><br /><br /><a href='../careers/job-postings.php'>Return to current opportunities</a></div>";
        }else {
            echo "<p style='color: #6D6E71; font-family: Arial,Helvetica,sans-serif; font-size: 13px;'>We accept resumes in <strong>.doc</strong>, <strong>.docx</strong>, <strong>.pdf</strong>, or <strong>.txt</strong> formats, 3MB or less. Please <a href='javascript:history.back(-1);'>go back</a> to upload a file that meets these requirements.<br /><br />If you continue to experience errors, please report them.</p>";
        }
    }


}