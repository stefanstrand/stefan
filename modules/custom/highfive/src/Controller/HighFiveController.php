<?php

/**
 * This Controller provides callback functionality for the highfive module.
 *
 * TODO: Task 2) Examine the tutorial() method.
 *
 * TODO: Task 3) Create about() method, which returns a dictionary definition
 *               of 'high five'
 *
 * TODO: Task 8) Create performHighFive($first, $second) method, which
 *               returns an HTML list of two URL arguments.
 */

namespace Drupal\highfive\Controller;

use Drupal\Core\Controller\ControllerBase;


/**
 * Controller routines for highfive routes.
 */
class HighFiveController extends ControllerBase {


  /**
   * {@inheritdoc}
   */
  protected function getModuleName() {
    return 'highfive';
  }

  // TASK 2: Examine the tutorial() method, below,
  //         which simply outputs HTML markup.
  //
  //         The HTML is generated in this fashion:
  //         a) obtain the path to a video file, using drupal_get_path
  //         b) Define some text to display. The text is wrapped in <p> tag.
  //         c) Put the video path defined in "step a" within a <video> tag.
  //         d) contcactenate (i.e. "combine") the two variables containing
  //            the HTML we just created in "step b" and "step c"
  //         e) Rerturn our HTML in a way that allows Drupal to theme it properly.

  /**
   * Constructs a simple page.
   *
   * The router _controller callback, maps the path
   * 'highfive/demo' to this method.
   *
   * _controller callbacks return a renderable array for the content area of the
   * page. The theme system will later render and surround the content with the
   * appropriate blocks, navigation, and styling.
   */
  public function tutorial() {
    // a) Get the full path to the video clip.
    $demo_vid_path = drupal_get_path('module', 'highfive') . '/assets/Curiosity_Rover_Begins_Mars_Mission_-_high-five_clip.240p.webm';

    // b) Define some text to display before the video.
    $paragraph_tag = '<p>' . $this->t('Watch NASA\'s Curiosity-rover team celebrate with high fives after the landing on Mars, August 2012.') . '<br /></p>';

    // c) Define the video markup
    $video_tag = '<video width="320" height="240" controls>
                    <source src="/' . $demo_vid_path . '" type="video/webm">
                  </video>';

    // d) Concatenate the two variables which contain the HTML to display.
    $markuphtml = $paragraph_tag . $video_tag;

    // e) Return the created HTML markup in a way that allows Drupal to
    //    theme our HTML. :)

    // Notice the short array syntax in the #allowed_tags key!
    // PRO TIP! Even though we are declaring markup (i.e. static html)
    //  We have to declare '#allowed_tags' because by default,
    //  in Drupal 8, the string passed to #markup is passed through
    //  \Drupal\Component\Utility\Xss::filterAdmin(),
    //  which strips known XSS vectors while allowing a permissive list of
    //  HTML tags that are not XSS vectors.
    //  You can use #allowed_tags to set the list of allowed tags,
    //  but that does not strop Drupal from stripping attributes (e.g. style).
    //  See Render API overview for more.
    //  https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Render%21theme.api.php/group/theme_render/8.4.x
    return array(
      '#type' => 'markup',
      '#markup' => $markuphtml,
      '#allowed_tags' => ['video', 'source', 'br'],
    );

  }

  // TODO: Task 3: Create public about() method.
  /**
   * Constructs a simple page.
   *
   * The router _controller callback, maps the path
   * 'examples/page-example/simple' to this method.
   *
   * _controller callbacks return a renderable array for the content area of the
   * page. The theme system will later render and surround the content with the
   * appropriate blocks, navigation, and styling.
   */
  public function about() {
    return [
      '#markup' => '<p>' . $this->t('A gesture of celebration or greeting in which two people slap each other\'s open palm with their arms raised.') . '</p>',
    ];
  }

  // TODO: Task 8: Create public performHighFive($first, $second) method.
  public function performHighFive($first, $second) {

    $list[] = $this->t("Person 1 is @name1.", ['@name1' => $first]);
    $list[] = $this->t("Person 2 is @name2.", ['@name2' => $second]);
    $list[] = $this->t('@name1 and @name2 gave each other a high five!',
      ['@name1' => $first, '@name2' => $second]);

    $render_array['page_example_arguments'] = [
      // The theme function to apply to the #items.
      '#theme' => 'item_list',
      // The list itself.
      '#items' => $list,
      '#title' => $this->t('Argument Information'),
    ];
    return $render_array;
  }


}
