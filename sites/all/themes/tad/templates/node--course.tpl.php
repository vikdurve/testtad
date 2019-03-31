<?php 
    
    global $base_url;
    global $user;
    $theme_path = url(drupal_get_path('theme', 'tad'));
    $node_wrapper = entity_metadata_wrapper('node', $node);
    
    $level_variants = $node_wrapper->field_level_variant->value();
    $language_variants = $node_wrapper->field_language_variant->value();
    
    $language_list[$node_wrapper->field_course_language->value()->tid]= array(
        'type'=>$node_wrapper->field_course_language->value()->name,
        'nid'=>$nid,
    ); 

    // echo "<pre>"; print_r($level_variants); echo "</pre>"; exit;
    
    if(count($language_variants) > 0) {
        foreach($language_variants as $variant) {
            $language_variant_wrapper = entity_metadata_wrapper('node', $variant->nid);
            $language_list[$language_variant_wrapper->field_course_language->value()->tid] = array(
                'type'=>$language_variant_wrapper->field_course_language->value()->name,
                'nid'=>$variant->nid,
            );
        }
    }
    
    $level_cards[$node_wrapper->field_course_type->value()->tid] = array(
        'type'=>$node_wrapper->field_course_type->value()->name,
        'nid'=>$nid,
        'duration'=>$node_wrapper->field_duration->value(),
        'modules'=>$node_wrapper->field_modules->value(),
        'effort'=>$node_wrapper->field_effort->value(),
        'pre-requisites'=>empty($node->field_pre_requisites) ? '' : $node_wrapper->field_pre_requisites->value->value(array('decode' => FALSE)),
        'cost'=>$node_wrapper->field_cost->value(),
        'status'=>$node_wrapper->field_course_status->value()
    );

    

    if(count($level_variants) > 0) {
        foreach($level_variants as $variant) {
            $level_variant_wrapper = entity_metadata_wrapper('node', $variant->nid);

            // echo "<pre>"; print_r($level_variant_wrapper->field_pre_requisites->value()); echo "</pre>"; exit;

            $level_cards[$level_variant_wrapper->field_course_type->value()->tid] = array(
                'type'=>$level_variant_wrapper->field_course_type->value()->name,
                'nid'=>$variant->nid,
                'duration'=>$level_variant_wrapper->field_duration->value(),
                'modules'=>$level_variant_wrapper->field_modules->value(),
                'effort'=>$level_variant_wrapper->field_effort->value(),
                'pre-requisites'=>empty($level_variant_wrapper->field_pre_requisites->value()) ? '' : $level_variant_wrapper->field_pre_requisites->value->value(array('decode' => FALSE)),
                'cost'=>$level_variant_wrapper->field_cost->value(),
                'status'=>$level_variant_wrapper->field_course_status->value()
            );
        }
    }

    ksort($level_cards);
    
   
    
?>

<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix" <?php print $attributes; ?>>
    <div class="gradientBannerWrp">
        <div class="tad-container">
            <div class="gradientBanner gradientBanner2">
                <div class="gradientBannerItem flex">
                    <div class="leftArea">
                        <h4 class="gradientBannerItemSubHeading">
                            <?php echo strtoupper($node_wrapper->field_category_of_course->value()->name); ?>
                        </h4>
                        <h4 class="gradientBannerItemHeading gradientBannerItemHeading2 fs40 rbold">
                            <?php echo $node_wrapper->field_course_display_name->value(); ?>
                        </h4>
                        <ul class="courseMeta">
                            <li>
                                <img src="<?php echo $theme_path;?>/images/gradientbanner/icons/duration.png" alt="duration">
                                <span class="numerical"><?php echo $node_wrapper->field_duration->value(); ?></span>
                            </li>
                            <li>
                                <img src="<?php echo $theme_path;?>/images/gradientbanner/icons/modules.png" alt="modules">
                                <span class="numerical"><?php echo $node_wrapper->field_modules->value();?> Modules</span>
                            </li>
                            <li>
                                <img src="<?php echo $theme_path;?>/images/gradientbanner/icons/time.png" alt="time">
                                <span class="numerical"><?php echo $node_wrapper->field_effort->value(); ?></span>
                            </li>
                        </ul>
                        <p class="course-difficulty">
                            <?php echo $node_wrapper->field_course_type->value()->name;?>
                        </p>
                    </div>

                    <div class="rightArea">

                        <div class="courseCTAMain flex">
                            <div class="course-cost-wrap">
                                <div class="course-cost numerical">
                                    <i class="fa fa-inr" aria-hidden="true"></i>

                                    <?php echo $node_wrapper->field_cost->value(); ?>
                                    <p>Excl. GST</p>
                                </div>
                                
                                <?php if(count($language_list)>1): ?>
                                    <div class="language-list">
                                        <select name="language-list" onchange="location = this.value;">
                                        <?php foreach($language_list as $lang): ?>
                                            <option value="<?php echo url('node/'.$lang['nid']);?>" <?php if($nid == $lang['nid']):?>selected<?php endif; ?>>
                                                <?php echo $lang['type'];?>
                                            </option>
                                        <?php endforeach; ?>
                                        </select>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="btnArea">
                                <!-- <a href="<?php echo $base_url.'/enrol/'.$nid ?>" class="btn btnEnrolNow btn-red w-border" role="button" aria-pressed="true">Enrol Now</a> -->
                                <a href="javascript:void(0)" class="btn btnEnrolNow btn-red w-border getin-touch-link" data-nid="<?php echo $nid; ?>" data-target="#get-in-touch-modal" data-toggle="modal">Enrol Now</a>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="course-overview-row">
        <div class="tad-container">
            <div class="course-overview-region">
                <div class="section-header">
                    <h4>Overview</h4>
                </div>

                <div class="course-overview-block">
                    <div class="vid-area videoPlaybackControl">
                        <?php print views_embed_view('course_overview_video', 'block', $nid); ?>
                    </div>

                    <div class="txt-area">
                        <?php 
                        if(!empty($node->body)) :
                            echo $node_wrapper->body->value->value(array('decode' => FALSE));
                        endif;
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <div class="syllabuswrap">
        <div class="tad-container">

            <div class="tadHeadingWrp section-header">
                <h4 class="tadHeading rbold fs24 ">Syllabus</h4>
                <p class="tadSubheading">
                    We have courses to suit both beginners and experienced professionals
                </p>
            </div>

            <div class="tadsyllabus-innerwrap section-body">
                <div class="tadsyllabus-tabswrap">
                    <div class="tadsyllabus-cardwrapper">
                        <?php if(count($level_cards) > 0):?>
                        <?php foreach($level_cards as $card):?>

                        <div class="tadsyllabus-individualcards <?php if($card['nid']==$nid ): ?>active<?php endif;?>">
                            <div class="syllabusheading-panel">
                                <a href="javascript:void(0)" class="syllabus-heading">
                                    <?php echo $card['type']; ?>
                                </a>
                            </div>

                            <div class="syllabuscard-middlepanel">
                                <ul class="list-inline syllabuscards-listingpanel">
                                    <li class="list-inline-item">
                                        <p class="labeltext">Duration</p>
                                        <h5 class="contenttext rmedium"><span class="numerical"><?php echo $card['duration']; ?></span></h5>
                                    </li>
                                    <li class="list-inline-item">
                                        <p class="labeltext">Syllabus</p>
                                        <h5 class="contenttext rmedium"><span class="numerical"><?php echo $card['modules']; ?></span> Modules</h5>
                                    </li>
                                    <li class="list-inline-item">
                                        <p class="labeltext">Effort</p>
                                        <h5 class="contenttext rmedium"><span class="numerical"><?php echo $card['effort']; ?></span></h5>
                                    </li>
                                </ul>
                            </div>
                            <?php if($card['status']): ?>
                            <div class="syllabus-bottompanel">
                                <div class="course-cost numerical">
                                    <i class="fa fa-inr" aria-hidden="true"></i>

                                    <?php echo $card['cost']; ?>
                                    <p>Excl. GST</p>
                                </div>
                                <div class="syllabusenroll-btnwrap">
                                    <!-- <a href="javascript:void(0)" class="btn btn-red rmedium">Enrol Now</a> -->
                                    <a href="javascript:void(0)" class="btn btn-red rmedium getin-touch-link" data-nid="<?php echo $card['nid']; ?>" data-target="#get-in-touch-modal" data-toggle="modal">Enrol Now</a>
                                </div>
                                <?php if(!empty($card['pre-requisites'])): ?>
                                    <div class="syllabusenroll-link-wrap">
                                        <a href="javascript:void(0)" class="tad-link pre-req-trigger">View Pre-requisites</a>
                                        <div class="pre-requisites-data">
                                            <div class="pre-requisites-wrap">
                                                <h4>Pre-requisites</h4>
                                                <div class="pre-requisites">
                                                    <?php echo $card['pre-requisites']; ?>
                                                </div>
                                            </div>                                            
                                        </div>
                                    </div>
                                <?php endif;?>
                            </div>
                            <?php else: ?>
                            <div class="syllabus-bottompanel">
                                <div class="locked-text">
                                    <img src="<?php echo $theme_path;?>/images/lock.png" alt="lock">
                                    <span>Locked</span>
                                    <p>To enrol for our Advanced Course,</p>
                                </div>
                                <div class="syllabusenroll-link-wrap">
                                    <a href="javascript:void(0)" class="tad-link getin-touch-link" data-nid="<?php echo $card['nid']; ?>" data-target="#get-in-touch-modal" data-toggle="modal">Get in touch</a>
                                </div>
                            </div>
                            <?php endif;?>
                        </div>

                        <?php endforeach;?>
                        <?php endif;?>
                    </div>
                </div>

                <div class="tab-content tadsyllabus-tabcontent">
                    <div class="foundation-tabcontent">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                                <div class="leftfoundation-coursecontent">
                                    <div class="foundationcourse-divwrap">
                                        <h4 class="commoncourse-heading">Course Content</h4>

                                        <div class="coursefoundation-accordion">
                                            <div class="coursefound-accinnerwrap">
                                                <?php print views_embed_view('course_content_module', 'block', $nid); ?>
                                            </div>

                                        </div>

                                        <div class="coursedownload-syllabuswrap">
                                            <a href="javascript:void(0)" class="downloadsyllabus-link">Download Syllabus
                                            <i class="fa fa-download" aria-hidden="true"></i>
                                            </a>
                                        </div>

                                    </div>


                                    <div class="foundationproject-divwrap">
                                        <h4 class="commoncourse-heading">Projects</h4>
                                        <?php 
                                            $inclusions = $node_wrapper->field_inclusions->value();
                                            if(count($inclusions)>0):
                                        ?>
                                        <div class="courseproject-owlcarousel">
                                            <?php 
                                                    $i=1;
                                                    foreach($inclusions as $inclusion):   
                                                ?>
                                            <div class="individualproject-cards">
                                                <div class="topproject-cardhead">
                                                    <h6 class="rmedium">
                                                        <?php echo $inclusion; ?>
                                                    </h6>
                                                </div>

                                                <!--<div class="bottomproject-cardbody">
                                                    <p class="rmedium">Project
                                                        <?php echo $i; ?>
                                                    </p>
                                                </div>-->
                                            </div>
                                            <?php 
                                                    $i++;
                                                    endforeach;
                                                ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                                <div class="rightfoundation-coursejournery">
                                    <h4 class="commoncourse-heading">Course Journery</h4>
                                    <?php echo views_embed_view('the_journey_of_courses', 'block_1');?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <section class="key-takeaways-row">
        <div class="tad-container">
            <div class="tadHeadingWrp section-header">
                <h4>Key Takeaways</h4>
            </div>
            <div class="key-takeaways-block">
                <?php print views_embed_view('benefits_of_this_course', 'block'); ?>
            </div>

        </div>
    </section>

    <section class="meet-mentors-row">
        <div class="tad-container">
            <div class="meet-mentors-region">
                <div class="section-header">
                    <h4>
                        Meet Our Mentors </h4>
                    <p>TAD brings to you a pool of the finest international mentors to teach you the best in your respective fields.</p>
                </div>
                <div class="meet-mentors-block">
                    <?php print views_embed_view('course_mentors', 'block', $nid); ?>
                </div>
            </div>
        </div>
    </section>


    <section class="faq-row">
        <div class="tad-container">

            <div class="section-header">
                <h4>
                    Frequently Asked Questions </h4>
                <p>Here you’ll find us address the most frequently raised course-related questions by students</p>
            </div>
            <div class="faq-section faq-section2">
                <?php print views_embed_view('faq', 'block'); ?>
            </div>

            <div class="faq-viewmore">
                <div class="linkArea txtCenter"><button class="btn btn-red lnkViewMore">View More</button></div>
            </div>
        </div>
    </section>
</article>
