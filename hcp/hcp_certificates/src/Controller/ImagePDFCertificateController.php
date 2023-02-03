<?php

namespace Drupal\hcp_certificates\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;

/**
 * Class BookingListController.
 */
class ImagePDFCertificateController extends ControllerBase
{

    /**
     * Page.
     * @key string helping avante
     * @return string
     *   Return Hello string.
     */
    public function page($key)
    {
        global $base_url;
        $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());

        $name = $user->field_first_name->getValue()[0]['value'] . ' ' . $user->field_last_name->getValue()[0]['value'];



        // Text offset for different heights of certificates
        $top_offset = 0;
        $id = 0;
        $top_offset = 0;
        $id = \Drupal::request()->request->get('id');
        if (!empty($id)) {
            $node = $this->getEntityEvent($id);
        }
        $class_end_date = \Drupal::request()->request->get('class_end_date');
        $class_end_date_year = date("Y",strtotime($class_end_date));

        // Create Image From Existing File
        $theme_handler = \Drupal::service('theme_handler');
        $default_theme = $theme_handler->getDefault();
        $theme_path = $theme_handler->getTheme($default_theme)->getPath();
        $png_image = imagecreatefrompng($theme_path . '/images/certificates/' . $key . '.png');

        // Allocate A Color For The Text
        $black = imagecolorallocate($png_image, 0, 0, 0);

        // Set Path to Font File
        $font_path = 'modules/custom/hcp/hcp_certificates/fonts/lato-regular.ttf';
        $font_path_bold = 'modules/custom/hcp/hcp_certificates/fonts/Lato-Semibold.ttf';
        $font_path_light = 'modules/custom/hcp/hcp_certificates/fonts/lato-light.ttf';

        //----------------------------------
        // Set Text to Be Printed On Image
        $name_text = $name;

        // Get image dimensions
        $width = imagesx($png_image);
        $height = imagesy($png_image);

        // Get center coordinates of image
        $centerX = $width / 2;

        // Get size of text
        list($left, $bottom, $right, , , $top) = imageftbbox(30, 0, $font_path, $name_text);
        // Determine offset of text
        $left_offset = ($right - $left) / 2;

        // Generate coordinates
        $x = $centerX - $left_offset;

        // Date
        // Set Text to Be Printed On Image
        $monthNames = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro','Outubro', 'Novembro', 'Dezembro'];
        if (!empty($id)) {
            $date_text = $node->get('field_start_date')->getValue()[0]['value'];
        }else {
            $date_text = date("d M Y");
        }
        $date_text_day = date("d",strtotime($date_text));
        $date_text_month = $monthNames[date("n",strtotime($date_text)) - 1];
        $date_text_year = date("Y",strtotime($date_text));
        $date_text = $date_text_day . " de " . $date_text_month . " de " . $date_text_year;

        // Print Text On Image
        imagettftext($png_image, 30, 0, $x, 360 + $top_offset, $black, $font_path, $name_text);

        //----------------------------------
        //Text Webinar
        if (!empty($node)) {
            $text_webinar = "Partcipou da aula \"" . $node->get('field_event_name')->getValue()[0]['value'] . "\" apresentada";

            // Get Bounding Box Size
            $text_box_webinar = imagettfbbox(14, 0, $font_path_light, $text_webinar);

            // Get your Text Width and Height
            $text_width_webinar = $text_box_webinar[2] - $text_box_webinar[0];
            $text_height_webinar = $text_box_webinar[7] - $text_box_webinar[1];

            // Calculate coordinates of the text
            $x_webinar = ($width / 2) - ($text_width_webinar / 2);
            $y_webinar = ($height / 2) - ($text_height_webinar / 2);

            imagettftext($png_image, 14, 0, $x_webinar, $y_webinar, $black, $font_path_light, $text_webinar);
        } else {
            $certificate_name = "Avante";
            switch ($key) {
                case "helping":
                    $certificate_name =  "Avante Helping Care";
                    break;
                case "avante":
                    $certificate_name =  "Avante Hospitalar";
                    break;
            }
            $text_webinar = "Concluiu o curso de extensão " . $class_end_date_year . " do " . $certificate_name;

            // Get Bounding Box Size
            $text_box_webinar = imagettfbbox(20, 0, $font_path_light, $text_webinar);

            // Get your Text Width and Height
            $text_width_webinar = $text_box_webinar[2] - $text_box_webinar[0];
            $text_height_webinar = $text_box_webinar[7] - $text_box_webinar[1];

            // Calculate coordinates of the text
            $x_webinar = ($width / 2) - ($text_width_webinar / 2);
            $y_webinar = ($height / 2) - ($text_height_webinar / 2);

            imagettftext($png_image, 20, 0, $x_webinar, $y_webinar, $black, $font_path_bold, $text_webinar);
        }
        //----------------------------------
        //Text Webinar Pressenters
        if (!empty($id)) {
            $text_webinar_pressenters = "pelos especialistas ";
            foreach ($node->field_presenter_list->referencedEntities() as $value => $paragraph) {
                $field_first_name = $paragraph->field_first_name->getValue()[0]['value'];
                $field_last_name = $paragraph->field_last_name->getValue()[0]['value'];
                $field_presenter_honorific = $paragraph->field_presenter_honorific->getValue()[0]['value'];

                $text_webinar_pressenters .= $field_presenter_honorific . ' ' . $field_first_name . ' ' . $field_last_name . ", ";
            }
            $text_webinar_pressenters = rtrim($text_webinar_pressenters,', ');
            $text_webinar_pressenters = preg_replace("/,([^,]+)$/", " e $1", $text_webinar_pressenters);

            // Get Bounding Box Size
            $text_box_webinar_pressenters = imagettfbbox(14, 0, $font_path_light, $text_webinar_pressenters);

            // Get your Text Width and Height
            $text_width_webinar_pressenters = $text_box_webinar_pressenters[2] - $text_box_webinar_pressenters[0];
            $text_height_webinar_pressenters = $text_box_webinar_pressenters[7] - $text_box_webinar_pressenters[1];

            // Calculate coordinates of the text
            $x_webinar_pressenters = ($width / 2) - ($text_width_webinar_pressenters / 2);
            $y_webinar_pressenters = ($height / 2) - ($text_height_webinar_pressenters / 2);

            imagettftext($png_image, 14, 0, $x_webinar_pressenters, $y_webinar_pressenters + 25, $black, $font_path_light, $text_webinar_pressenters);
        }
        //----------------------------------
        //Text
        if (!empty($id)) {
            $text_webinar_text = "Essa partcipação contará com carga horária de 1 hora.";

            // Get Bounding Box Size
            $text_box_webinar_text = imagettfbbox(14, 0, $font_path_light, $text_webinar_text);

            // Get your Text Width and Height
            $text_width_webinar_text = $text_box_webinar_text[2] - $text_box_webinar_text[0];
            $text_height_webinar_text = $text_box_webinar_text[7] - $text_box_webinar_text[1];

            // Calculate coordinates of the text
            $x_webinar_text = ($width / 2) - ($text_width_webinar_text / 2);
            $y_webinar_text = ($height / 2) - ($text_height_webinar_text / 2);

            imagettftext($png_image, 14, 0, $x_webinar_text, $y_webinar_text + 50, $black, $font_path_bold, $text_webinar_text);
        }
        //----------------------------------

        // Get image dimensions
        $width = imagesx($png_image);

        // Get center coordinates of image
        $centerX = $width / 2;

        // Get size of text
        list($left, $bottom, $right, , , $top) = imageftbbox(16, 0, $font_path_light, $date_text);
        // Determine offset of text
        $left_offset = ($right - $left) / 2;

        // Generate coordinates
        $x = $centerX - $left_offset;

        // Print Text On Image
        if (!empty($id)) {
            imagettftext($png_image, 16, 0, $x, 530 + $top_offset, $black, $font_path_light, $date_text);
        }else {

            $date_text_month_fdc = $monthNames[date("n",strtotime($class_end_date)) - 1];
            $date_text_year_fdc = date("Y",strtotime($class_end_date));
            $date_text_fdc = $date_text_month_fdc . " de " . $date_text_year_fdc;

            imagettftext($png_image, 16, 0, $x + 40, 530 + $top_offset, $black, $font_path_light, $date_text_fdc);
        }

        //----------------------------------

        $tmpFile = tmpfile();
        $meta_data = stream_get_meta_data($tmpFile);
        $tmpPath = $meta_data["uri"];
        fclose($tmpFile);

        imagepng($png_image, $tmpPath);

        $src = base64_encode(file_get_contents($tmpPath));

        echo $html = '<html><head></head><body><img src="data: image/png;base64,' . $src . '" onload="window.print();"></body></html>';
        exit;

        $print_engine = \Drupal::service('plugin.manager.entity_print.print_engine')->createSelectedInstance('pdf');
        $print_engine->getPrintObject()->ignoreWarnings = TRUE;
        $print_engine->addPage($html);
        $print_engine->send('certificate.pdf');

        return [];
    }

    private function getEntityEvent( $nid )
    {
        if (!empty($nid)) {
            $node = \Drupal\node\Entity\Node::load($nid);
            return $node;
        }
        return null;
    }

}

