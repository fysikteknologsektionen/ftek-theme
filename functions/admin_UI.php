<?php

/* Dashboard widgets, more info here: http://codex.wordpress.org/Dashboard_Widgets_API */

/* Remove other dashboard widgets */

function ftek_remove_all_dashboard_meta_boxes()
{
    global $wp_meta_boxes;
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
        unset($wp_meta_boxes['dashboard']['normal']['core']['wordfence_activity_report_widget']);
        unset($wp_meta_boxes['dashboard']['normal']['core']['booked_upcoming_appointments']);
        $wp_meta_boxes['dashboard']['side']['core'] = array();
}
add_action('wp_dashboard_setup', 'ftek_remove_all_dashboard_meta_boxes', 9999 );

function add_dashboard_tutorial_widgets() {
    $widgets = array(
        array(
            'slug' => 'ftek_guidelines',
            'title' => 'Riktlinjer – läs innan du skriver!',
            'position' => 'side',
        ),
        array(
            'slug' => 'howto_news',
            'title' => 'Att skriva en nyhet', 
            'position' => 'normal',
        ),
        array(
            'slug' => 'howto_event',
            'title' => 'Att skapa ett evenemang',
            'position' => 'normal',
        ),
        array(
            'slug' => 'howto_slideshow',
            'title' => 'Att lägga till bilder på TV:n på Focus',
            'position' => 'normal',
        ),
        array(
            'slug' => 'howto_edit_page',
            'title' => 'Att redigera en sida',
            'position' => 'normal',
        ),
        array(
            'slug' => 'howto_subpage',
            'title' => 'Att lägga till en undersida',
            'position' => 'normal',
        ),
        array(
            'slug' => 'howto_course_pages',
            'title' => 'Att redigera en kurssida',
            'position' => 'normal',
            'capability' => 'edit_others_course_pages',
        ),
        array(
            'slug' => 'howto_committee_picture',
            'title' => 'Att ändra föreningsbild',
            'position' => 'normal',
        ),
        array(
            'slug' => 'howto_profile_picture',
            'title' => 'Att ändra profilbild',
            'position' => 'normal',
        ),
    );
        foreach ($widgets as $widget) {
            $cap = $widget['capability'];
            if( !$cap || current_user_can($cap) ) {
                add_meta_box(
                    $widget['slug'] . '_widget', // Widget slug
                    $widget['title'], // Title (duh)
                    $widget['slug'], // Display function
                    'dashboard', // Place
                    $widget['position'] // Position
                );
            }
        }
}
add_action( 'wp_dashboard_setup', 'add_dashboard_tutorial_widgets', 10000);

/**
 * Tutorial widgets
 */
function ftek_guidelines()
{   
    ?>
    <ul>
        <li><strong>Håll det seriöst.</strong> Det som står på hemsidan är sektionens officiella uttalanden. Glimten i ögat uppskattas, men prioritera kommunikation över humor.</li>
        <li><strong>Länka gärna.</strong> Om du t.ex. nämner någon förening i en nyhet, länka till föreningens sida, så gör du det mycket trevligare för sidans besökare. Använd länkfunktionen så att länkarna ser ut såhär: <a href="http://example.com">exempellänk</a>, inte såhär: http://example.com.</li>
        <li><strong>Inga hemligheter.</strong> Den här sidan är till för att förmedla information, och allt som finns på den går att läsa av allmänheten. Så du rekommenderas sköta hemliga saker någon annanstans.</li>
        <li><strong>Spamma inte.</strong> Tänk på vad sektionsmedlemmarna kan vara intresserade av, och vad som bara är relevant för en mindre grupp. Om en nyhet inte rör hela sektionen kanske den inte ska vara på framsidan, till exempel.</li>
        <li><strong>Skriv på engelska.</strong> Av hänsyn till våra icke-svensktalande sektionsmedlemmar bör större delen av informationen finnas tillgänglig på både svenska och engelska.</li>
        <li><strong>Skriv <em>inte</em> på engelska.</strong>  Om en nyhet eller ett evenemang endast rör svensktalande studenter, fyll bara i fälten för svenska. Då syns inte dessa nyheter/evenemang på den engelska sidan, vilket bör leda till mindre förvirring.</li>
        <li><strong>Sabotera inte.</strong> I nuläget kan du redigera andra föreningars sidor, nyheter och evenemang på hemsidan. Fixa gärna fel om du ser dem, men ändra inte saker för att sabotera. Det går lätt att spåra och ändra tillbaka, och du riskerar att bli utkastad härifrån.</li>
        <li><strong>Undvik upphovsrättskyddat material.</strong> Använd i första hand bilder och text som du skapat själv. I andra hand kan du använda bilder med en öppen licens, som du kan hitta t.ex. med <a href="http://search.creativecommons.org">CC Search</a> eller <a href="https://www.google.se/search?q=chalmers&tbm=isch&tbs=sur:fc">Googles bildsök med rättighetsfilter</a>.
    </ul>
    <?php
} 

function howto_news() {
    ?>
    <ol>
        <li>Gå in på <a href="/wp-admin/edit.php"><em>Inlägg</em></a> &rarr; <a href="/wp-admin/post-new.php"><em>Skapa nytt</em></a></li>
        <li>Fyll i rubrik och text.</li>
        <li>Lägg till relevanta kategorier.</li>
        <li>Välj en <em>utvald bild</em> (helst en som är bredare än hög).</li>
        <li>Om det är relevant, fyll i engelsk rubrik och text genom att använda flaggorna högst upp på sidan.</li>
    </ol>
    <?php
} 

function howto_event() {
    ?>
    <ol>
        <li>Gå in på <a href="/wp-admin/edit.php?post_type=event"><em>Evenemang</em></a> &rarr; <a href="/wp-admin/post-new.php?post_type=event"><em>Lägg till nytt</em></a></li>
        <li>Fyll i rubrik och beskrivning.</li>
        <li>Välj tid och plats. Finns inte platsen bland de befintliga, skapa en ny.</li>
        <li>Välj relevanta kategorier.</li>
        <li>Välj en <em>utvald bild</em>. Om den är i formatet 16:9 (t.ex. 1366×768 eller 1920×1080) så läggs den automatiskt upp på TV:n på Focus.</li>
        <li>Om det är relevant, fyll i engelsk rubrik och beskrivning.</li>
    </ol>
    <?php
}

function howto_slideshow() {
    ?>
    <ol>
        <li>Gå in på <a href="/wp-admin/edit.php?post_type=vegas"><em>WP Vegas</em></a>.</li>
        <li>Klicka in på <a href="/wp-admin/post.php?post=1570&action=edit"><em>Default 16:9 1366x768</em></a>.</li>
        <li>Klicka på <em>Add Slides</em> och ladda upp din bild som måste vara i 16:9 format.</li>
        <li>Lägg till kategorin <em>Slideshow</em> till bilden när du har laddat upp den.</li>
        <li>Klicka på <em>Uppdatera</em> till höger.</li>
        <li>TV:n uppdaterar med 15 minuters mellanrum, men du kan <a href="/slideshow/">förhandvisa här</a>.</li>
    </ol>
    <?php
}

function howto_edit_page() {
    ?>
    <ol>
        <li>Gå in på <a href="/wp-admin/edit.php?post_type=page"><em>Sidor</em></a> och hitta den sida du vill redigera.</li>
        <li>Titta på hur andra sidor har skrivits annars fråga Spidera om hjälp.</li>
    </ol>
    <?php
}

function howto_subpage() {
    ?>
    <ol>
        <li>Gå in på <a href="/wp-admin/edit.php?post_type=page"><em>Sidor</em></a> &rarr; <a href="/wp-admin/post-new.php?post_type=page"><em>Skapa ny</em></a></li>
        <li>Fyll i sidnamn och innehåll på både svenska och engelska.</li>
        <li>Välj din förenings huvudsida som föräldersida.</li>
        <li>Om du vill, välj en specifik <em>utvald bild</em> för undersidan och beskär den vettigt. Om du inte väljer en specifik bild används samma som på föreningens huvudsida.</li>
    </ol>
    <?php
}

function howto_course_pages() {
    ?>
    <ol>
        <li>Gå in på <a href="/wp-admin/edit.php?post_type=ftek_course_page"><em>Kurssidor</em></a> och välj kursens sida. Finns den inte, välj <a href="/wp-admin/post-new.php?post_type=ftek_course_page"><em>skapa ny</em></a>.</li>
        <li>Uppdatera och fyll i så mycket information du kan.</li>
        <li>Om startsidan visar fel kurser, uppdatera läsperiodtiderna under <em>Inställningar</em> &rarr; <a href="/wp-admin/options-general.php?page=ftekcp_settings"><em>Ftek kurssidor</em></a>.</li>
    </ol>
    <?php
}

function howto_committee_picture() {
    ?>
    <ol>
        <li>Gå in på <a href="/wp-admin/edit.php?post_type=page"><em>Sidor</em></a> och hitta den föreningssida du vill redigera.</li>
        <li>Hitta rutan <em>Utvald bild</em> nere till höger och klicka på den nuvarande bilden. Om ingen nuvarande bild finns angiven använder sidan bilden från föreningens huvudsida.</li>
        <li>Hitta fältet <em>Ersätt media</em> till höger och klicka på <em>Ladda upp en ny fil</em>.</li>
        <li>Ladda upp den nya bilden under <em>Choose Replacement Image</em>.</li>
        <li>Se till att <em>Ersätt bara filen</em> är markerat och klicka på <em>Ladda upp</em>.</li>
        <li>Besök föreningssidan och kontrollera att det ser ut som det ska.</li>
    </ol>
    <?php
}

function howto_profile_picture() {
    ?>
    <ol>
        <li>Gå in på googles <a href="https://aboutme.google.com/"><em>Om mig</em></a> och byt profilbild där.</li>
        <li>Att byta profilbild någon annanstans fungerar inte.</li>
        <li>Ftek hämtar automatiskt profilbilder från google en gång per dygn.</li>
    </ol>
    <?php
}

/* Simplify editing interface */

if (is_admin()) {
    function ftek_remove_meta_boxes() {
    remove_meta_box('linktargetdiv', 'link', 'normal');
    remove_meta_box('linkxfndiv', 'link', 'normal');
    remove_meta_box('linkadvanceddiv', 'link', 'normal');
    
    remove_meta_box('postexcerpt', 'post', 'normal');
    remove_meta_box('trackbacksdiv', 'post', 'normal');
    remove_meta_box('postcustom', 'post', 'normal');
    remove_meta_box('slugdiv', 'post', 'normal');
    remove_meta_box('commentstatusdiv', 'post', 'normal');
    remove_meta_box('commentsdiv', 'post', 'normal');
    remove_meta_box('revisionsdiv', 'post', 'normal');
    remove_meta_box('authordiv', 'post', 'normal');
    remove_meta_box('sqpt-meta-tags', 'post', 'normal');
    remove_meta_box('tagsdiv-post_tag', 'post', 'normal');
    
    remove_meta_box('authordiv', 'page', 'normal');
    remove_meta_box('postcustom', 'page', 'normal');
    remove_meta_box('commentstatusdiv', 'page', 'normal');
    remove_meta_box('permalinkdiv', 'page', 'normal');
    
    remove_meta_box('postexcerpt', 'event', 'normal');
    remove_meta_box('trackbacksdiv', 'event', 'normal');
    remove_meta_box('postcustom', 'event', 'normal');
    remove_meta_box('slugdiv', 'event', 'normal');
    remove_meta_box('commentstatusdiv', 'event', 'normal');
    remove_meta_box('commentsdiv', 'event', 'normal');
    remove_meta_box('revisionsdiv', 'event', 'normal');
    remove_meta_box('authordiv', 'event', 'normal');
    remove_meta_box('sqpt-meta-tags', 'event', 'normal');
    remove_meta_box('tagsdiv-post_tag', 'event', 'normal');
    
    remove_meta_box('qts_sectionid', 'post', 'side');
    remove_meta_box('qts_sectionid', 'page', 'side');
    remove_meta_box('qts_sectionid', 'event', 'side');
    remove_meta_box('qts_sectionid', 'ftek_course_page', 'side');
    }
    add_action( 'admin_menu', 'ftek_remove_meta_boxes');
}