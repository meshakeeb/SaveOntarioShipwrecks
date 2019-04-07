<?php
require( get_theme_file_path().'/customization/assets/fpdf/fpdf.php');

class BoltPDF extends FPDF
{



    // Page header
    function Header()
    {
        unset($bolt_user);
        $bolt_user = $this->userinfo($user_id, $data);
        $this->Image( get_theme_file_path().'/customization/assets/images/pdf-bg.png',0,0,$this->w, $this->h);        
        $this->Image( get_theme_file_path().'/customization/assets/images/pdf-logo.gif',1,1);
        $this->SetFont('Arial','',12);      
        $this->Cell(0,0,date('F d, Y'),0,0,'R');
        $this->Ln(20);
        $this->SetFont('Arial','B',12);      
        $this->Cell(0,0,"Dear ".$bolt_user['fname']." ".$bolt_user['lname'],0,0,'B');
        $this->Ln(10);
        //Page Background
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        $this->SetTextColor(0,0,255);
        $this->SetFont('','U');
        $this->Cell(0,0,"Save Ontario Shipwrecks",0,0,"C",false,"http://saveontarioshipwrecks.ca/");
    }

    function userinfo($user_id, $data = array() ){
        unset($bolt_user);
        unset($user_ID);
        
        if ( is_page(array('family-member'))) {
            $data['user_id'] = $user_id;
        } else if ( isset($_GET['page']) && $_GET['page'] === "pms-members-page") {
            $data['user_id'] = $_POST['pms-member-username'];
        }
        

        $user_ID = get_userdata($data['user_id']);
        $bolt_user['ID'] = $user_ID->data->ID;
        $chapter = get_user_meta($user_ID->data->ID,'chapter',true);

        $chairman = BoltMediaFront::get_chapter_chair($chapter);

        $bolt_user['email'] = $user_ID->data->user_email;
        $bolt_user['fname'] = ( get_user_meta($user_ID->data->ID,'billing_first_name', true) ) ? get_user_meta($user_ID->data->ID,'billing_first_name', true) : $_POST['first_name'];
        $bolt_user['lname'] = ( get_user_meta($user_ID->data->ID,'billing_last_name', true) != "" ) ? get_user_meta($user_ID->data->ID,'billing_last_name', true) : $_POST['last_name'];
        $bolt_user['expiry'] = date('F j, Y', strtotime($data['expiration_date']));
        $bolt_user['chapter'] = ( get_the_title( $chapter ) != "") ? get_the_title( $chapter ) : get_the_title($_POST['chapter']);
        $bolt_user['chairman'] = get_user_meta($chairman->ID,'billing_first_name', true).' ' . get_user_meta($chairman->ID,'billing_last_name', true);
        $bolt_user['chairman_mail'] = $chairman->user_email;

        return $bolt_user;
    }    


    function generatePDFArgs($user_id, $data) {
        
        clearstatcache();
        unset($bolt_user);        
        $bolt_user = $this->userinfo($user_id, $data);
        do_action('pdf_hook', $bolt_user );
        do_action('pdf_hook2', $bolt_user );

    }    


    function generatePDF($bolt_user){

        $this->AliasNbPages();
        $this->AddPage();
        $badge = BoltImage::PDFBadge($bolt_user);

        sleep(2);

        $this->SetFont('Arial','',12);
        $this->SetTextColor(0,0,0);

        $this->Write(5,'It is my pleasure to welcome you as a member of Save Ontario Shipwrecks (SOS). We on the Board hope that you will find membership in our organization fun and rewarding.');
        $this->Ln(10);

        $this->Write(5,"I encourage you to explore the SOS Website, "); 

        $this->SetTextColor(0,0,255);
        $this->SetFont('','U');
        $this->Write(5,"SaveOntarioShipwrecks.ca", "http://saveontarioshipwrecks.ca/");

        $this->SetTextColor(0,0,0);
        $this->SetFont('','');
        $this->Write(5,", and to contact your Chapter Chair,");

        if( $bolt_user['chairman'] !== "" ){
            $this->SetTextColor(0,0,255);
            $this->SetFont('','U');
            $this->Write(5,$bolt_user['chairman'], "mailto:".$bolt_user['chairman_mail']);

            $this->SetTextColor(0,0,0);
            $this->SetFont('','');
        }    

        $this->Write(5,", to get familiar with activities and upcoming events, and to find an area of personal interest where you would like to contribute. We're always looking for new ideas and different perspectives to keep our projects and events fresh and relevant to our goals.");

        $this->Ln(10);
        $this->Write(5,"As a Provincial Heritage Organization in Ontario, SOS promotes an appreciation of the province's rich marine heritage through a number of initiatives.  This work is carried out by volunteers: members, like you, who want to make a difference.");
        $this->Ln(10);
        $this->Write(5,"As a member of SOS, you have the opportunity to take part in activities such as training through the Nautical Archaeology Society, research and survey projects, buoy deployment and site monitoring, public education and outreach, and much more. Active participation in SOS programs can provide an extremely fulfilling and satisfying experience: this is an area where an individual can make a significant and lasting contribution to a worthwhile cause.");
        $this->Ln(10);
        $this->Write(5,"Below is a membership card for you to cut out and carry with pride, knowing that you are helping to preserve Ontario's marine heritage for future generations.");
        $this->Ln(10);
        $this->Write(5, "Yours truly,");
        $this->Ln(5);
        //$this->Image( get_theme_file_path().'/customization/assets/images/pdf-signature.png');
        //$this->Ln(5);
        $this->Write(5, "Jennifer Bush");
        $this->Ln(5);
        $this->Write(5, "President, Save Ontario Shipwrecks");
        $this->Ln(10);
        $this->Write(5, iconv('UTF-8', 'windows-1252',"* Si vous désirer recevoir cette lettre en français ils nous feras un grand plaisir de faire la traduction.") );
        $this->Ln(20);

        //$this->Write(5, $badge );
        //if( file_exists($badge) ){
            $this->Cell(50);
            $this->Image( $badge );            
        //}


        $this->Output(wp_upload_dir()['basedir'].'/member_badges/user_'.$bolt_user['ID'].'.pdf', 'F');

        $this->EmailPDF($bolt_user['ID']);

        unset($bolt_user);
    }


    function EmailPDF($order_id){

            $badges = get_option('email_badges');

            $headers = null;
            $headers .= 'From: Save Ontario Shipwrecks <wordpress@saveontarioshipwrecks.ca>' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

            $attach = WP_CONTENT_DIR.'\uploads\member_badges\user_'.$order_id.'.pdf';

            $pdf = get_bloginfo('url').'/wp-content/uploads/member_badges/user_'.$order_id.'.pdf';
            $name = get_user_meta($order_id,'billing_first_name',true);

            $message_default = null;
            $message_default .= '<p>Hello '.$name.',</p>';
            $message_default .= '<p>Please see your Save Ontario Shipwrecks membership card attached to this email.</p>';
                
            $message_default .= '<p>Or alternatively, you may visit <a href="'.$pdf.'">'.$pdf.'</a> to view and save your card.</p>';
            $message_default .= '<p>Thank You for Preserving Our Marine Heritage</p>';
            $message_default .= '<p>Save Ontario Shipwrecks</p>';

            $message = ($badges['content'] === "") ? $message_default : str_replace( array('{fname}', '{pdf}'), array($name, $pdf), $badges['content']); 

            $title = ($badges['title'] === "") ? "Your Save Ontario Shipwrecks membership card" : $badges['title'];

            wp_mail( get_userdata($order_id)->user_email, $title, $message, $headers, $attach );
    }    


}


