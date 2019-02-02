<?php

/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type; for example, story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode; for example, "full", "teaser".
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 *
 * @ingroup templates
 */
?>

<?php 
    // dpm($node);
    // echo "<pre>"; print_r($node);echo "</pre>";
    $node_wrapper = entity_metadata_wrapper('node', $node);
    global $base_url;
    global $user;
    $theme_path = url(drupal_get_path('theme', 'tad'));
?>

<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
<div class="gradientBannerWrp">
    <div class="tadContainer">
        <div class="gradientBanner gradientBanner2">
            <div class="gradientBannerItem flex">
                <div class="leftArea">
                    <h4 class="gradientBannerItemSubHeading rbold"><?php echo $node_wrapper->field_category_of_course->value()->name; ?></h4>
                    <h4 class="gradientBannerItemHeading gradientBannerItemHeading2 fs40 rbold">
                        <?php echo $node_wrapper->field_course_display_name->value(); ?>
                    </h4>
                    <ul class="courseMeta">
                        <li>
                            <img src="<?php echo $theme_path;?>/images/gradientbanner/icons/duration.png">
                            <span class="numerical"><?php echo $node_wrapper->field_duration->value(); ?></span>
                        </li>
                        <li>
                            <img src="<?php echo $theme_path;?>/images/gradientbanner/icons/modules.png">
                            <span class="numerical"><?php echo $node_wrapper->field_modules->value();?> Modules</span> 
                        </li>
                        <li>
                            <img src="<?php echo $theme_path;?>/images/gradientbanner/icons/time.png">
                            <span class="numerical"><?php echo $node_wrapper->field_effort->value(); ?></span>
                        </li>
                    </ul>
                    <p class="langAvailability fs16">(<?php echo $node_wrapper->field_course_type->value()->name;?> Course)</p>
                </div>

                <div class="rightArea">
                    <div class="courseCTAMain flex">
                        <div class="course-cost"><?php echo $node_wrapper->field_cost->value(); ?></div>
                        <div class="btnArea">
                            <a href="contactcounsellor.aspx" class="btn btnEnrolNow btn-red w-border" role="button" aria-pressed="true">Get in touch</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="overviewWrp">
    <div class="tadContainer">
        <div class="overview">
            
            <div class="tadHeadingWrp section-header">
                <h4 class="tadHeading rbold fs24">Overview</h4>
            </div>
            
            <div class="overviewContent mob-pd-t-0 section-body">
                <div class="imgArea videoPlaybackControl">
                    <?php print views_embed_view('course_overview_video', 'block', $nid); ?>
                </div>

                <div class="txtArea">
                    <?php echo $node_wrapper->body->value->value(array('decode' => TRUE)); ?>
                </div>

            </div>
        </div>
    </div>
</section>

<div class="syllabuswrap">
    <div class="tadContainer">
        
        <div class="tadHeadingWrp section-header">
            <h4 class="tadHeading rbold fs24 ">Syllabus</h4>
            <p class="tadSubheading">
                We have courses to suit both beginners and experienced professionals
            </p>
        </div>
        
        <?php print views_embed_view('course_content_module', 'block', $nid); ?>

        <div class="tadsyllabus-innerwrap section-body">
            <div class="tadsyllabus-tabswrap">
                <div class="tadsyllabus-cardwrapper">
                    <div class="tadsyllabus-individualcards active">
                        <div class="syllabusheading-panel">

                            <a href="javascript:void(0)" class="syllabus-heading">Foundation</a>
                            
                        </div>
                        <!--End o fthe syllabus heading panel-->
                        <div class="syllabuscard-middlepanel">
                            <ul class="list-inline syllabuscards-listingpanel">
                                <li class="list-inline-item">
                                    <p class="labeltext">Duration</p>
                                    <h5 class="contenttext rmedium"><span class="numerical">40</span> hours</h5>
                                </li>
                                <li class="list-inline-item">
                                    <p class="labeltext">Syllabus</p>
                                    <h5 class="contenttext rmedium"><span class="numerical">4</span> Modules</h5>
                                </li>
                                <li class="list-inline-item">
                                    <p class="labeltext">Effort</p>
                                    <h5 class="contenttext rmedium"><span class="numerical">3</span> Hrs./Week</h5>
                                </li>

                            </ul>
                        </div>
                        <!--End o fthe syllabus cards middle panel-->
                        <div class="syllabus-bottompanel">
                            
                            <!--End of the payment syllabus div-->
                            <div class="syllabusenroll-btnwrap">
                                <a href="contactcounsellor.aspx" class="btn btn-red rmedium">Get in touch</a>
                            </div>
                            <!--End of the syllabus enroll btn wrapper-->
                           
                            <!--End of the syllabus prequities-->
                        </div>
                        <!--End of the syllabus bottom panel-->
                    </div>
                    <!--End of the tad syllabus individual cards-->
                    <div class="tadsyllabus-individualcards smallsyllabus-individualcards">
                        <div class="syllabusheading-panel">
                           
                            <a href="javascript:void(0)" class="syllabus-heading">Advanced</a>

                        </div>
                        <!--End o fthe syllabus heading panel-->
                        <div class="syllabuscard-middlepanel">
                            <ul class="list-inline syllabuscards-listingpanel">
                                <li class="list-inline-item">
                                    <p class="labeltext">Duration</p>
                                    <h5 class="contenttext rmedium"><span class="numerical">40</span> Hours</h5>
                                </li>
                                <li class="list-inline-item">
                                    <p class="labeltext">Syllabus</p>
                                    <h5 class="contenttext rmedium"><span class="numerical">4</span> Modules</h5>
                                </li>
                                <li class="list-inline-item">
                                    <p class="labeltext">Effort</p>
                                    <h5 class="contenttext rmedium"><span class="numerical">3</span> Hrs./Week</h5>
                                </li>

                            </ul>
                        </div>
                        <!--End o fthe syllabus cards middle panel-->
                        <div class="advsyllabus-bottompanel">
                            <div class="lockedelement-div">
                                <h6>
                                    <img src="<?php echo $theme_path;?>/images/tadcourses/lockedimg.png" alt="">
                                    <span>Locked</span>
                                </h6>
                                <p class="lockedelement-content">To enrol for our Advanced Course, you must complete the Beginner Course or take a quiz to prove your proficiency.</p>
                            </div>
                            <!--End of the locked element div-->
                        </div>
                        <!--End of the syllabus bottom panel-->
                    </div>
                    <!--End of the tad syllabus individual cards-->

                </div>
                <!--End of the tad syllabus card wrapper-->
            </div>
            <!--end of the tad syllabus tabs wreapper-->
            <div class="tab-content tadsyllabus-tabcontent">
                <div class="foundation-tabcontent">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                            <div class="leftfoundation-coursecontent">
                                <div class="foundationcourse-divwrap">
                                    <h4 class="commoncourse-heading">Course Content</h4>

                                    <div class="coursefoundation-accordion">
                                        <div class="coursefound-accinnerwrap">
                                            <div class="individualcourse-accordionpanel">
                                                <div class="courseacc-headpanel">
                                                    <h6 class="accheading rbold">Module 0 : Introduction to TAD</h6>
                                                    <p class="acchead-time numerical">20 min</p>
                                                </div>
                                                <!--End of the course accordion head panel-->
                                            </div>
                                            <!--End of the individual course accordion panel-->
                                            <div class="individualcourse-accordionpanel">
                                                <div class="courseacc-headpanel">
                                                    <h6 class="accheading rbold">Module 1 : Introduction to UX</h6>
                                                    <p class="acchead-time numerical">90 min</p>
                                                </div>
                                                <!--End of the course accordion head panel-->
                                                <div class="courseacc-bodypanel">
                                                    <ul class="list-inline coursecontent-listingpanel">
                                                        <li>
                                                            <img src="<?php echo $theme_path;?>/images/tadcourses/norteicon.jpg" alt="">
                                                            <span>What is UX?</span>

                                                        </li>
                                                        <li>
                                                            <img src="<?php echo $theme_path;?>/images/tadcourses/playicon.jpg" alt="">
                                                            <span>Fundamentals of UX Design</span>
                                                        </li>

                                                    </ul>
                                                </div>
                                                <!--End of the course acc body panel-->
                                            </div>
                                            <!--End of the individual course accordion panel-->
                                            <div class="individualcourse-accordionpanel">
                                                <div class="courseacc-headpanel">
                                                    <h6 class="accheading rbold">Module 2 : Introduction to Project</h6>
                                                    <p class="acchead-time numerical">30 min</p>
                                                </div>
                                                <!--End of the course accordion head panel-->
                                            </div>
                                            <!--End of the individual course accordion panel-->
                                            <div class="individualcourse-accordionpanel">
                                                <div class="courseacc-headpanel">
                                                    <h6 class="accheading rbold">Module 3 : Psychology and UX</h6>
                                                    <p class="acchead-time numerical">360 min</p>
                                                </div>
                                                <!--End of the course accordion head panel-->
                                                <div class="courseacc-bodypanel">
                                                    <ul class="list-inline coursecontent-listingpanel">
                                                        <li>
                                                            <img src="<?php echo $theme_path;?>/images/tadcourses/norteicon.jpg" alt="">
                                                            <span>What is Psychology?</span>

                                                        </li>
                                                        <li>
                                                            <img src="<?php echo $theme_path;?>/images/tadcourses/playicon.jpg" alt="">
                                                            <span>Importance of understanding user psychology</span>
                                                        </li>
                                                        <li>
                                                            <img src="<?php echo $theme_path;?>/images/tadcourses/norteicon.jpg" alt="">
                                                            <span>Attention?</span>

                                                        </li>
                                                    </ul>
                                                </div>
                                                <!--End of the course acc body panel-->
                                            </div>
                                            <!--End of the individual course accordion panel-->
                                        </div>
                                        <!--End of the course foundation accordion inner wrapper-->
                                    </div>
                                    <!--End of the course foundation accordion-->
                                    <div class="coursedownload-syllabuswrap">
                                        <a href="javascript:void(0)" class="downloadsyllabus-link">Download Syllabus
                                    <i class="fa fa-download" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <!--End o fthe course download syllabus wrap-->

                                </div>
                                <!--End of the foundation course div wrap-->

                                <div class="foundationproject-divwrap">
                                    <h4 class="commoncourse-heading">Projects</h4>
                                    <div class="courseproject-owlcarousel">
                                        <div class="owl-carousel owl-theme commoncourse-owlcarsouel owl-loaded owl-drag">
                                            
                                            <!--End of the item-->
                                            
                                            <!--End of the item-->
                                            
                                            <!--End of the item-->

                                        <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 795px;"><div class="owl-item active" style="width: auto; margin-right: 10px;"><div class="item">
                                                <div class="individualproject-cards">
                                                    <div class="topproject-cardhead">
                                                        <h6 class="rmedium">Predicting Boston Housing Prices</h6>
                                                    </div>
                                                    <!--End of the top project card heading-->
                                                    <div class="bottomproject-cardbody">
                                                        <p class="rmedium">Project 1</p>
                                                    </div>
                                                    <!--End of the bottom project card body-->
                                                </div>
                                                <!--End of the individual project cards-->
                                            </div></div><div class="owl-item active" style="width: auto; margin-right: 10px;"><div class="item">
                                                <div class="individualproject-cards">
                                                    <div class="topproject-cardhead">
                                                        <h6 class="rmedium">Find Donors for CharityML</h6>
                                                    </div>
                                                    <!--End of the top project card heading-->
                                                    <div class="bottomproject-cardbody">
                                                        <p class="rmedium">Project 2</p>
                                                    </div>
                                                    <!--End of the bottom project card body-->
                                                </div>
                                                <!--End of the individual project cards-->
                                            </div></div><div class="owl-item active" style="width: auto; margin-right: 10px;"><div class="item">
                                                <div class="individualproject-cards">
                                                    <div class="topproject-cardhead">
                                                        <h6 class="rmedium">Creating Customer Segments</h6>
                                                    </div>
                                                    <!--End of the top project card heading-->
                                                    <div class="bottomproject-cardbody">
                                                        <p class="rmedium">Project 3</p>
                                                    </div>
                                                    <!--End of the bottom project card body-->
                                                </div>
                                                <!--End of the individual project cards-->
                                            </div></div></div></div><div class="owl-nav disabled"><div class="owl-prev">prev</div><div class="owl-next">next</div></div><div class="owl-dots disabled"></div></div>
                                        <!--End of the project owl carsouel-->
                                    </div>
                                    <!--End of the course project owl carsouel-->
                                </div>
                                <!--End of the foundation project div wrap-->

                                <div class="foundationproject-divwrap">
                                    <h4 class="commoncourse-heading">Services</h4>
                                    <div class="courseproject-owlcarousel">
                                        <div class="owl-carousel owl-theme commoncourse-owlcarsouel servicecourse-owlcarousel owl-loaded owl-drag">
                                            
                                            <!--End of the item-->
                                            
                                            <!--End of the item-->
                                            
                                            <!--End of the item-->

                                        <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 795px;"><div class="owl-item active" style="width: auto; margin-right: 10px;"><div class="item">
                                                <div class="individualproject-cards">
                                                    <div class="topproject-cardhead">
                                                        <h6 class="rmedium">Question And Answer Forum</h6>
                                                    </div>
                                                    <!--End of the top project card heading-->

                                                </div>
                                                <!--End of the individual project cards-->
                                            </div></div><div class="owl-item active" style="width: auto; margin-right: 10px;"><div class="item">
                                                <div class="individualproject-cards">
                                                    <div class="topproject-cardhead">
                                                        <h6 class="rmedium">Free Webinar With Expert</h6>
                                                    </div>
                                                    <!--End of the top project card heading-->
                                                </div>
                                                <!--End of the individual project cards-->
                                            </div></div><div class="owl-item active" style="width: auto; margin-right: 10px;"><div class="item">
                                                <div class="individualproject-cards">
                                                    <div class="topproject-cardhead">
                                                        <h6 class="rmedium">30 Days Accessibility</h6>
                                                    </div>
                                                    <!--End of the top project card heading-->
                                                </div>
                                                <!--End of the individual project cards-->
                                            </div></div></div></div><div class="owl-nav disabled"><div class="owl-prev">prev</div><div class="owl-next">next</div></div><div class="owl-dots disabled"></div></div>
                                        <!--End of the project owl carsouel-->
                                    </div>
                                    <!--End of the course project owl carsouel-->
                                </div>
                                <!--End of the foundation project div wrap-->

                            </div>
                            <!--end of the left foundaion course content-->
                        </div>
                        <!--End of the row cols md 8-->
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                            <div class="rightfoundation-coursejournery">
                                <h4 class="commoncourse-heading">Course Journery</h4>
                                <?php echo views_embed_view('the_journey_of_courses', 'block_1');?>
                            </div>
                            <!--End of the right foundation-courser journery-->
                        </div>
                        <!--End of the row cols md 8-->

                    </div>
                    <!--End of the row-->
                </div>
                <!--End of the founation tab content-->
            </div>
            <!--End of the tad syllabus tab content-->

        </div>
        <!--End of the tad syllabus inner wrapper-->

    </div>
    <!--End of the tad container-->
</div>

<section class="overviewWrp">
    <div class="tadContainer">
        <div class="overview"> 
            <div class="tadHeadingWrp section-header">
                <h4 class="tadHeading rbold fs24">Benefits of This Course</h4>
            </div>
            <div class="overviewContent mob-pd-t-0 section-body">
                <?php print views_embed_view('benefits_of_this_course', 'block'); ?>
            </div>
        </div>
    </div>
</article>

<section class="overviewWrp">
    <div class="tadContainer">
        <div class="overview"> 
            <div class="tadHeadingWrp section-header">
                <h4 class="tadHeading rbold fs24">Meet Your Mentors</h4>
            </div>
            <div class="overviewContent mob-pd-t-0 section-body">
                <?php print views_embed_view('course_mentors', 'block', $nid); ?>
            </div>
        </div>
    </div>
</article>

<section class="overviewWrp">
    <div class="tadContainer">
        <div class="overview"> 
            <div class="tadHeadingWrp section-header">
                <h4 class="tadHeading rbold fs24">Frequently Asked Question</h4>
            </div>
            <div class="overviewContent mob-pd-t-0 section-body">
                <?php print views_embed_view('faq', 'block'); ?>
            </div>
        </div>
    </div>
</article>