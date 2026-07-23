<?php /* Template Name: Page - Training */ ?>

<?php get_header('', array( 'body-classes' => 'training-index') ); ?>

<main>

<header>

<div>
<h1><?php the_title(); ?></h1>
</div>

<figure>
    <?php $image = get_field('header_graphic'); ?>
    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

    <figcaption>
        <p><?php echo $image['caption']; ?></p>

    </figcaption>
</figure>
</header>

<?php $testimonial1 = get_field('testimonial_1_content'); ?>
<?php $testimonial2 = get_field('testimonial_2_content'); ?>

<?php if(get_field('subhead_title')) : ?>
<article class="topic-summary about">
    <div class="description">
        <?php if (get_field('subhead_title')) : ?>
        <h2><?php the_field('subhead_title'); ?></h2>
        <?php endif; ?>

        <?php the_field('subhead_intro'); ?>

        <?php if (get_field('subhead_link_text')) : ?>
        <a href="<?php the_field('subhead_link_url'); ?>"><?php the_field('subhead_link_text'); ?></a>
        <?php endif; ?>
    </div>

    <figure>
        <?php $image = get_field('subhead_graphic'); ?>
        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

        <figcaption>
            <p><?php echo $image['caption']; ?></p>

        </figcaption>
    </figure>

</article>
<?php endif; ?>

<?php if(get_field('display_training_flow_section')) : ?>

    <article class="training-flow">
        <?php the_field('training_flow_content'); ?>

        <ol>
            <li>
                <details name="step" open>
                    <summary>Free Training Video Library <span class="icon icon-replace fa-angle-up"></span></summary>
                    <article class="posts">
                    <!-- <p>a bunch of content here</p> -->
                    <ul>


                        <li>
                        <article class="post">
                            <header>
                            <h3 class="title"><a href="https://stage.creativecommons.org/2023/09/26/explore-the-2023-cc-global-summit-program/">Explore the 2023 CC Global Summit Program</a></h3>
                                    <span class="byline">by
                                
                                <a href="https://stage.creativecommons.org/person/cc/">Creative Commons</a>
                                                                                    </span>
                                    <span class="categories">
                                <a href="https://stage.creativecommons.org/category/about-cc/events/" rel="category tag">Events</a>        </span>
                            </header>

                            <figure>
                                            <img src="https://creativecommons.org/wp-content/uploads/2023/08/SomosElBienComún16x9-1024x576.jpg" alt="A colorful illustration of a wall of windows, each showing a different figure, including an axolotl and humans engaged in various activities, one wearing a blue luchador mask, and others holding a slender blue line hung with a light blue CC Global Summit banner, all surrounded by butterflies, birds, vines, and flowering plants.">
                            </figure>
                        </article>
                        </li>

                        
                        
                        <li>
                        <article class="post">
                            <header>
                            <h3 class="title"><a href="https://stage.creativecommons.org/2023/09/26/explorar-el-programa-de-la-cumbre-mundial-cc-2023/">Explorar el Programa de la Cumbre Mundial CC 2023</a></h3>
                                    <span class="byline">by
                                
                                <a href="https://stage.creativecommons.org/person/cc/">Creative Commons</a>
                                                                                    </span>
                                    <span class="categories">
                                <a href="https://stage.creativecommons.org/category/about-cc/events/" rel="category tag">Events</a>        </span>
                            </header>

                            <figure>
                                            <img src="https://creativecommons.org/wp-content/uploads/2023/08/SomosElBienComún16x9-1024x576.jpg" alt="A colorful illustration of a wall of windows, each showing a different figure, including an axolotl and humans engaged in various activities, one wearing a blue luchador mask, and others holding a slender blue line hung with a light blue CC Global Summit banner, all surrounded by butterflies, birds, vines, and flowering plants.">
                            </figure>
                        </article>
                        </li>

                        
                        
                        <li>
                        <article class="post">
                            <header>
                            <h3 class="title"><a href="https://stage.creativecommons.org/2023/09/26/christy-henshaw-open-culture-voices-season-2-episode-26/">Christy Henshaw — Open Culture VOICES, Season 2 Episode 26</a></h3>
                                    <span class="byline">by
                                
                                <a href="https://stage.creativecommons.org/person/brigittevezina/">Brigitte Vézina</a>,
                                                            
                                <a href="https://stage.creativecommons.org/person/connorbenedict/">Connor Benedict</a>
                                                                                    </span>
                                    <span class="categories">
                                <a href="https://stage.creativecommons.org/category/uncategorized/" rel="category tag">Uncategorized</a>        </span>
                            </header>

                            <figure>
                                            <img src="https://creativecommons.org/wp-content/uploads/2023/08/Christy.png" alt="Screenshot from Christy Henshaw from Open Culture Voices by Creative Commons, Creative Commons Attribution 4.0 License">
                            </figure>
                        </article>
                        </li>

                        
                        
                        <li>
                        <article class="post">
                            <header>
                            <h3 class="title"><a href="https://stage.creativecommons.org/2023/09/23/marina-nunez-bespalova-sera-una-oradora-principal-en-la-cumbre-mundial-cc-2023/">Marina Núñez Bespalova Será una Oradora Principal en la Cumbre Mundial CC 2023</a></h3>
                                    <span class="byline">by
                                
                                <a href="https://stage.creativecommons.org/person/cc/">Creative Commons</a>
                                                                                    </span>
                                    <span class="categories">
                                <a href="https://stage.creativecommons.org/category/community/" rel="category tag">Community</a>, <a href="https://stage.creativecommons.org/category/about-cc/events/" rel="category tag">Events</a>, <a href="https://stage.creativecommons.org/category/open-culture/" rel="category tag">Open Culture</a>        </span>
                            </header>

                            <figure>
                                            <img src="https://creativecommons.org/wp-content/uploads/2023/09/CCGlobalSummitKeynoteMarinaNúñezBespalova-1024x576.png" alt="A headshot of Marina Núñez Bespalova, speaking at a microphone and wearing a light top and dark suit jacket, to the right of a colorful illustration of a wall of windows, each revealing a different human or animal doing some activity, on a building decorated with a light blue CC Global Summit banner hanging from a slender blue line, surrounded by yellow butterflies and birds and green vines and plants.">
                            </figure>
                        </article>
                        </li>

                        
                        
                        <li>
                        <article class="post">
                            <header>
                            <h3 class="title"><a href="https://stage.creativecommons.org/2023/09/23/marina-nunez-bespalova-to-keynote-cc-global-summit-2023/">Marina Núñez Bespalova to Keynote CC Global Summit 2023</a></h3>
                                    <span class="byline">by
                                
                                <a href="https://stage.creativecommons.org/person/cc/">Creative Commons</a>
                                                                                    </span>
                                    <span class="categories">
                                <a href="https://stage.creativecommons.org/category/community/" rel="category tag">Community</a>, <a href="https://stage.creativecommons.org/category/about-cc/events/" rel="category tag">Events</a>, <a href="https://stage.creativecommons.org/category/open-culture/" rel="category tag">Open Culture</a>        </span>
                            </header>

                            <figure>
                                            <img src="https://creativecommons.org/wp-content/uploads/2023/09/CCGlobalSummitKeynoteMarinaNúñezBespalova-1024x576.png" alt="A headshot of Marina Núñez Bespalova, speaking at a microphone and wearing a light top and dark suit jacket, to the right of a colorful illustration of a wall of windows, each revealing a different human or animal doing some activity, on a building decorated with a light blue CC Global Summit banner hanging from a slender blue line, surrounded by yellow butterflies and birds and green vines and plants.">
                            </figure>
                        </article>
                        </li>

                        
                        
                        <li>
                        <article class="post">
                            <header>
                            <h3 class="title"><a href="https://stage.creativecommons.org/2023/09/22/cc-defends-better-sharing-and-the-commons-in-wipo-conversation-on-generative-ai/">CC Defends Better Sharing and the Commons in WIPO Conversation on Generative AI</a></h3>
                                    <span class="byline">by
                                
                                <a href="https://stage.creativecommons.org/person/brigittevezina/">Brigitte Vézina</a>
                                                                                    </span>
                                    <span class="categories">
                                <a href="https://stage.creativecommons.org/category/policy/better-internet/" rel="category tag">Better Internet</a>, <a href="https://stage.creativecommons.org/category/policy/copyright/" rel="category tag">Copyright Reform</a>, <a href="https://stage.creativecommons.org/category/open-culture/" rel="category tag">Open Culture</a>        </span>
                            </header>

                            <figure>
                                            <img src="https://creativecommons.org/wp-content/uploads/2023/09/BrigitteVézinaWIPO21092023-1024x576.jpg" alt="A World Intellectual Property Organization title slide saying Ms. Brigitte Vézina, Director, Policy and Open Culture, Creative Commons, decorated with purple and green abstract shapes and a large, gray number 8, next to a screen capture of Brigitte Vézina smiling and wearing earbuds.">
                            </figure>
                        </article>
                        </li>
                  
                    </ul>
                    </article>
                </details>
            </li>

            <li>
                <details name="step">
                    <summary>Assessment for Digital Credential <span class="icon icon-replace fa-angle-up"></span></summary>

                    <article class="posts">
                        <p>[placeholder content here]</p>
                    </article>
                </details>
            </li>

            <li>
                <details name="step">
                    <summary>Seminar Courses <span class="icon icon-replace fa-angle-up"></span></summary>

                    <article class="posts">
                        <ul>


                        <li>
                        <article class="post">
                            <header>
                            <h3 class="title"><a href="https://stage.creativecommons.org/2023/09/26/explore-the-2023-cc-global-summit-program/">Explore the 2023 CC Global Summit Program</a></h3>
                                    <span class="byline">by
                                
                                <a href="https://stage.creativecommons.org/person/cc/">Creative Commons</a>
                                                                                    </span>
                                    <span class="categories">
                                <a href="https://stage.creativecommons.org/category/about-cc/events/" rel="category tag">Events</a>        </span>
                            </header>

                            <figure>
                                            <img src="https://creativecommons.org/wp-content/uploads/2023/08/SomosElBienComún16x9-1024x576.jpg" alt="A colorful illustration of a wall of windows, each showing a different figure, including an axolotl and humans engaged in various activities, one wearing a blue luchador mask, and others holding a slender blue line hung with a light blue CC Global Summit banner, all surrounded by butterflies, birds, vines, and flowering plants.">
                            </figure>
                            <p>summary here</p>
                        </article>
                        </li>

                        
                        
                        <li>
                        <article class="post">
                            <header>
                            <h3 class="title"><a href="https://stage.creativecommons.org/2023/09/26/explorar-el-programa-de-la-cumbre-mundial-cc-2023/">Explorar el Programa de la Cumbre Mundial CC 2023</a></h3>
                                    <span class="byline">by
                                
                                <a href="https://stage.creativecommons.org/person/cc/">Creative Commons</a>
                                                                                    </span>
                                    <span class="categories">
                                <a href="https://stage.creativecommons.org/category/about-cc/events/" rel="category tag">Events</a>        </span>
                            </header>

                            <figure>
                                            <img src="https://creativecommons.org/wp-content/uploads/2023/08/SomosElBienComún16x9-1024x576.jpg" alt="A colorful illustration of a wall of windows, each showing a different figure, including an axolotl and humans engaged in various activities, one wearing a blue luchador mask, and others holding a slender blue line hung with a light blue CC Global Summit banner, all surrounded by butterflies, birds, vines, and flowering plants.">
                            </figure>
                        </article>
                        </li>

                        
                        
                        <li>
                        <article class="post">
                            <header>
                            <h3 class="title"><a href="https://stage.creativecommons.org/2023/09/26/christy-henshaw-open-culture-voices-season-2-episode-26/">Christy Henshaw — Open Culture VOICES, Season 2 Episode 26</a></h3>
                                    <span class="byline">by
                                
                                <a href="https://stage.creativecommons.org/person/brigittevezina/">Brigitte Vézina</a>,
                                                            
                                <a href="https://stage.creativecommons.org/person/connorbenedict/">Connor Benedict</a>
                                                                                    </span>
                                    <span class="categories">
                                <a href="https://stage.creativecommons.org/category/uncategorized/" rel="category tag">Uncategorized</a>        </span>
                            </header>

                            <figure>
                                            <img src="https://creativecommons.org/wp-content/uploads/2023/08/Christy.png" alt="Screenshot from Christy Henshaw from Open Culture Voices by Creative Commons, Creative Commons Attribution 4.0 License">
                            </figure>
                        </article>
                        </li>

                        
                        
                        <li>
                        <article class="post">
                            <header>
                            <h3 class="title"><a href="https://stage.creativecommons.org/2023/09/23/marina-nunez-bespalova-sera-una-oradora-principal-en-la-cumbre-mundial-cc-2023/">Marina Núñez Bespalova Será una Oradora Principal en la Cumbre Mundial CC 2023</a></h3>
                                    <span class="byline">by
                                
                                <a href="https://stage.creativecommons.org/person/cc/">Creative Commons</a>
                                                                                    </span>
                                    <span class="categories">
                                <a href="https://stage.creativecommons.org/category/community/" rel="category tag">Community</a>, <a href="https://stage.creativecommons.org/category/about-cc/events/" rel="category tag">Events</a>, <a href="https://stage.creativecommons.org/category/open-culture/" rel="category tag">Open Culture</a>        </span>
                            </header>

                            <figure>
                                            <img src="https://creativecommons.org/wp-content/uploads/2023/09/CCGlobalSummitKeynoteMarinaNúñezBespalova-1024x576.png" alt="A headshot of Marina Núñez Bespalova, speaking at a microphone and wearing a light top and dark suit jacket, to the right of a colorful illustration of a wall of windows, each revealing a different human or animal doing some activity, on a building decorated with a light blue CC Global Summit banner hanging from a slender blue line, surrounded by yellow butterflies and birds and green vines and plants.">
                            </figure>
                        </article>
                        </li>

                        
                        
                        <li>
                        <article class="post">
                            <header>
                            <h3 class="title"><a href="https://stage.creativecommons.org/2023/09/23/marina-nunez-bespalova-to-keynote-cc-global-summit-2023/">Marina Núñez Bespalova to Keynote CC Global Summit 2023</a></h3>
                                    <span class="byline">by
                                
                                <a href="https://stage.creativecommons.org/person/cc/">Creative Commons</a>
                                                                                    </span>
                                    <span class="categories">
                                <a href="https://stage.creativecommons.org/category/community/" rel="category tag">Community</a>, <a href="https://stage.creativecommons.org/category/about-cc/events/" rel="category tag">Events</a>, <a href="https://stage.creativecommons.org/category/open-culture/" rel="category tag">Open Culture</a>        </span>
                            </header>

                            <figure>
                                            <img src="https://creativecommons.org/wp-content/uploads/2023/09/CCGlobalSummitKeynoteMarinaNúñezBespalova-1024x576.png" alt="A headshot of Marina Núñez Bespalova, speaking at a microphone and wearing a light top and dark suit jacket, to the right of a colorful illustration of a wall of windows, each revealing a different human or animal doing some activity, on a building decorated with a light blue CC Global Summit banner hanging from a slender blue line, surrounded by yellow butterflies and birds and green vines and plants.">
                            </figure>
                        </article>
                        </li>

                        
                        
                        <li>
                        <article class="post">
                            <header>
                            <h3 class="title"><a href="https://stage.creativecommons.org/2023/09/22/cc-defends-better-sharing-and-the-commons-in-wipo-conversation-on-generative-ai/">CC Defends Better Sharing and the Commons in WIPO Conversation on Generative AI</a></h3>
                                    <span class="byline">by
                                
                                <a href="https://stage.creativecommons.org/person/brigittevezina/">Brigitte Vézina</a>
                                                                                    </span>
                                    <span class="categories">
                                <a href="https://stage.creativecommons.org/category/policy/better-internet/" rel="category tag">Better Internet</a>, <a href="https://stage.creativecommons.org/category/policy/copyright/" rel="category tag">Copyright Reform</a>, <a href="https://stage.creativecommons.org/category/open-culture/" rel="category tag">Open Culture</a>        </span>
                            </header>

                            <figure>
                                            <img src="https://creativecommons.org/wp-content/uploads/2023/09/BrigitteVézinaWIPO21092023-1024x576.jpg" alt="A World Intellectual Property Organization title slide saying Ms. Brigitte Vézina, Director, Policy and Open Culture, Creative Commons, decorated with purple and green abstract shapes and a large, gray number 8, next to a screen capture of Brigitte Vézina smiling and wearing earbuds.">
                            </figure>
                        </article>
                        </li>
                  
                    </ul>
                    </article>
                </details>
            </li>

            <li>
                <details name="step">
                    <summary>CC Certifcation <span class="icon icon-replace fa-angle-up"></span></summary>

                    <article class="posts">
                        <ul>


                        <li>
                        <article class="post">
                            <header>
                            <h3 class="title"><a href="https://stage.creativecommons.org/2023/09/26/explore-the-2023-cc-global-summit-program/">Explore the 2023 CC Global Summit Program</a></h3>
                                    <span class="byline">by
                                
                                <a href="https://stage.creativecommons.org/person/cc/">Creative Commons</a>
                                                                                    </span>
                                    <span class="categories">
                                <a href="https://stage.creativecommons.org/category/about-cc/events/" rel="category tag">Events</a>        </span>
                            </header>

                            <figure>
                                            <img src="https://creativecommons.org/wp-content/uploads/2023/08/SomosElBienComún16x9-1024x576.jpg" alt="A colorful illustration of a wall of windows, each showing a different figure, including an axolotl and humans engaged in various activities, one wearing a blue luchador mask, and others holding a slender blue line hung with a light blue CC Global Summit banner, all surrounded by butterflies, birds, vines, and flowering plants.">
                            </figure>
                            <p>summary here</p>
                        </article>
                        </li>

                        
                        
                        <li>
                        <article class="post">
                            <header>
                            <h3 class="title"><a href="https://stage.creativecommons.org/2023/09/26/explorar-el-programa-de-la-cumbre-mundial-cc-2023/">Explorar el Programa de la Cumbre Mundial CC 2023</a></h3>
                                    <span class="byline">by
                                
                                <a href="https://stage.creativecommons.org/person/cc/">Creative Commons</a>
                                                                                    </span>
                                    <span class="categories">
                                <a href="https://stage.creativecommons.org/category/about-cc/events/" rel="category tag">Events</a>        </span>
                            </header>

                            <figure>
                                            <img src="https://creativecommons.org/wp-content/uploads/2023/08/SomosElBienComún16x9-1024x576.jpg" alt="A colorful illustration of a wall of windows, each showing a different figure, including an axolotl and humans engaged in various activities, one wearing a blue luchador mask, and others holding a slender blue line hung with a light blue CC Global Summit banner, all surrounded by butterflies, birds, vines, and flowering plants.">
                            </figure>
                        </article>
                        </li>

                        
                        
                        <li>
                        <article class="post">
                            <header>
                            <h3 class="title"><a href="https://stage.creativecommons.org/2023/09/26/christy-henshaw-open-culture-voices-season-2-episode-26/">Christy Henshaw — Open Culture VOICES, Season 2 Episode 26</a></h3>
                                    <span class="byline">by
                                
                                <a href="https://stage.creativecommons.org/person/brigittevezina/">Brigitte Vézina</a>,
                                                            
                                <a href="https://stage.creativecommons.org/person/connorbenedict/">Connor Benedict</a>
                                                                                    </span>
                                    <span class="categories">
                                <a href="https://stage.creativecommons.org/category/uncategorized/" rel="category tag">Uncategorized</a>        </span>
                            </header>

                            <figure>
                                            <img src="https://creativecommons.org/wp-content/uploads/2023/08/Christy.png" alt="Screenshot from Christy Henshaw from Open Culture Voices by Creative Commons, Creative Commons Attribution 4.0 License">
                            </figure>
                        </article>
                        </li>

                        
                        
                        <li>
                        <article class="post">
                            <header>
                            <h3 class="title"><a href="https://stage.creativecommons.org/2023/09/23/marina-nunez-bespalova-sera-una-oradora-principal-en-la-cumbre-mundial-cc-2023/">Marina Núñez Bespalova Será una Oradora Principal en la Cumbre Mundial CC 2023</a></h3>
                                    <span class="byline">by
                                
                                <a href="https://stage.creativecommons.org/person/cc/">Creative Commons</a>
                                                                                    </span>
                                    <span class="categories">
                                <a href="https://stage.creativecommons.org/category/community/" rel="category tag">Community</a>, <a href="https://stage.creativecommons.org/category/about-cc/events/" rel="category tag">Events</a>, <a href="https://stage.creativecommons.org/category/open-culture/" rel="category tag">Open Culture</a>        </span>
                            </header>

                            <figure>
                                            <img src="https://creativecommons.org/wp-content/uploads/2023/09/CCGlobalSummitKeynoteMarinaNúñezBespalova-1024x576.png" alt="A headshot of Marina Núñez Bespalova, speaking at a microphone and wearing a light top and dark suit jacket, to the right of a colorful illustration of a wall of windows, each revealing a different human or animal doing some activity, on a building decorated with a light blue CC Global Summit banner hanging from a slender blue line, surrounded by yellow butterflies and birds and green vines and plants.">
                            </figure>
                        </article>
                        </li>

                        
                        
                        <li>
                        <article class="post">
                            <header>
                            <h3 class="title"><a href="https://stage.creativecommons.org/2023/09/23/marina-nunez-bespalova-to-keynote-cc-global-summit-2023/">Marina Núñez Bespalova to Keynote CC Global Summit 2023</a></h3>
                                    <span class="byline">by
                                
                                <a href="https://stage.creativecommons.org/person/cc/">Creative Commons</a>
                                                                                    </span>
                                    <span class="categories">
                                <a href="https://stage.creativecommons.org/category/community/" rel="category tag">Community</a>, <a href="https://stage.creativecommons.org/category/about-cc/events/" rel="category tag">Events</a>, <a href="https://stage.creativecommons.org/category/open-culture/" rel="category tag">Open Culture</a>        </span>
                            </header>

                            <figure>
                                            <img src="https://creativecommons.org/wp-content/uploads/2023/09/CCGlobalSummitKeynoteMarinaNúñezBespalova-1024x576.png" alt="A headshot of Marina Núñez Bespalova, speaking at a microphone and wearing a light top and dark suit jacket, to the right of a colorful illustration of a wall of windows, each revealing a different human or animal doing some activity, on a building decorated with a light blue CC Global Summit banner hanging from a slender blue line, surrounded by yellow butterflies and birds and green vines and plants.">
                            </figure>
                        </article>
                        </li>

                        
                        
                        <li>
                        <article class="post">
                            <header>
                            <h3 class="title"><a href="https://stage.creativecommons.org/2023/09/22/cc-defends-better-sharing-and-the-commons-in-wipo-conversation-on-generative-ai/">CC Defends Better Sharing and the Commons in WIPO Conversation on Generative AI</a></h3>
                                    <span class="byline">by
                                
                                <a href="https://stage.creativecommons.org/person/brigittevezina/">Brigitte Vézina</a>
                                                                                    </span>
                                    <span class="categories">
                                <a href="https://stage.creativecommons.org/category/policy/better-internet/" rel="category tag">Better Internet</a>, <a href="https://stage.creativecommons.org/category/policy/copyright/" rel="category tag">Copyright Reform</a>, <a href="https://stage.creativecommons.org/category/open-culture/" rel="category tag">Open Culture</a>        </span>
                            </header>

                            <figure>
                                            <img src="https://creativecommons.org/wp-content/uploads/2023/09/BrigitteVézinaWIPO21092023-1024x576.jpg" alt="A World Intellectual Property Organization title slide saying Ms. Brigitte Vézina, Director, Policy and Open Culture, Creative Commons, decorated with purple and green abstract shapes and a large, gray number 8, next to a screen capture of Brigitte Vézina smiling and wearing earbuds.">
                            </figure>
                        </article>
                        </li>
                  
                    </ul>
                    </article>
                </details>
            </li>
        </ol>
        
    </article>

<?php endif; ?>

    <?php if($testimonial1) : ?>
    <blockquote>
        <p><?php echo $testimonial1;  ?></p>
    </blockquote>
    <?php endif; ?>

<?php if(get_field('display_training_events_section')) : ?>
<article class="topic-dive">
    <h2><?php the_field('training_events_title'); ?></h2>
    <p><?php the_field('training_events_tagline'); ?></p>

    <article class="topic-summary focus-area">
        <div class="description">

            <?php the_field('training_events_content'); ?>

            <a href="<?php the_field('training_events_url'); ?>"><?php the_field('training_events_link_text'); ?></a>
        </div>

        <figure>
            <?php $image = get_field('training_events_graphic'); ?>
            <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

            <figcaption>
                <p><?php echo $image['caption']; ?></p>

            </figcaption>
        </figure>

        <article class="trainings">
            <ul>
                <?php if(get_field('training_event_1_title')) : ?>
                <li>
                    <article class="training">
                        <h3><?php the_field('training_event_1_title'); ?></h3>
                        <?php the_field('training_event_1_description'); ?>

                        <h4><?php the_field('training_event_1_list_title'); ?></h4>

                        <?php the_field('training_event_1_list_content'); ?>
                        <a href="<?php the_field('training_event_1_link_url'); ?>"><?php the_field('training_event_1_link_text'); ?></a>
                    </article>
                </li>
                <?php endif; ?>

                <?php if(get_field('training_event_2_title')) : ?>
                <li>
                    <article class="training">
                        <h3><?php the_field('training_event_2_title'); ?></h3>
                        <?php the_field('training_event_2_description'); ?>

                        <h4><?php the_field('training_event_2_list_title'); ?></h4>

                        <?php the_field('training_event_2_list_content'); ?>
                        <a href="<?php the_field('training_event_2_link_url'); ?>"><?php the_field('training_event_1_link_text'); ?></a>
                    </article>
                </li>
                <?php endif; ?>

                <?php if(get_field('training_event_3_title')) : ?>
                <li>
                    <article class="training">
                        <h3><?php the_field('training_event_3_title'); ?></h3>
                        <?php the_field('training_event_3_description'); ?>

                        <h4><?php the_field('training_event_3_list_title'); ?></h4>

                        <?php the_field('training_event_3_list_content'); ?>
                        <a href="<?php the_field('training_event_3_link_url'); ?>"><?php the_field('training_event_1_link_text'); ?></a>
                    </article>
                </li>
                <?php endif; ?>

                <?php if(get_field('training_event_4_title')) : ?>
                <li>
                    <article class="training">
                        <h3><?php the_field('training_event_4_title'); ?></h3>
                        <?php the_field('training_event_4_description'); ?>

                        <h4><?php the_field('training_event_4_list_title'); ?></h4>

                        <?php the_field('training_event_4_list_content'); ?>
                        <a href="<?php the_field('training_event_4_link_url'); ?>"><?php the_field('training_event_1_link_text'); ?></a>
                    </article>
                </li>
                <?php endif; ?>
            </ul>
        </article>

    </article>

</article>
<?php endif; ?>

<!-- topic features here -->
 <?php
    $topic_features = get_field('topic_features');
    if( !empty($topic_features) ) :
?>

<?php $post_index = 0; ?>
<?php foreach($topic_features as $topic_feature) : ?>
    <?php $post_index++; ?>
    <?php
        $permalink = get_permalink( $topic_feature->ID );
        $title = get_the_title( $topic_feature->ID );
        $category = get_field( 'category', $topic_feature->ID );
        $link_text = get_field( 'link_text', $topic_feature->ID );
        $link_url = get_field( 'link_url', $topic_feature->ID );
        $type = get_field( 'type', $topic_feature->ID );
        if ($type == 'default') { $type = 'focus-area';}
        // $content = get_the_content( $topic_feature->ID );
        $content = get_post_field('post_content', $topic_feature->ID);
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);
        // $excerpt = get_the_excerpt( $staff_person->ID );
        ?>

        <article class="topic-summary <?php echo $type; ?>">
        <div class="description">
            <h2><?php echo $title; ?></h2>
            <span class="category"><?php echo $category; ?></span>
            <?php echo $content; ?>

            <?php if ($link_text) : ?>
            <a href="<?php echo $link_url; ?>"><?php echo $link_text; ?></a>
            <?php endif; ?>
        </div>
        <figure>
            <img src="<?php echo get_the_post_thumbnail_url( $topic_feature->ID, 'full' ); ?>" alt="<?php echo get_post_meta ( get_post_thumbnail_id($topic_feature->ID), '_wp_attachment_image_alt', true ); ?>" />

            <figcaption>
                <p><?php echo get_the_post_thumbnail_caption( $topic_feature->ID ); ?></p>
            </figcaption>
        </figure>
    </article>

    <?php if ($post_index == 1) : ?>

        <?php if ($testimonial2) : ?>

        <blockquote>
            <p><?php echo $testimonial2;  ?></p>
        </blockquote>

        <?php endif; ?>

    <?php endif; ?>


    <?php endforeach; ?>

<?php endif; ?>

<?php if (get_field('more_links_display')) : ?>
<aside class="more-links">
    <nav>
        <h2>More Links</h2>
        <?php the_field('more_links_content'); ?>
    </nav>
</aside>
<?php endif; ?>

<?php get_template_part( 'content-partials/bottom', 'newsletter_promo', '' ); ?>

</main>

<?php get_footer(); ?>
