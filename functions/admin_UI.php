<?php

/* Dashboard widgets, more info here: http://codex.wordpress.org/Dashboard_Widgets_API */

/* Remove other dashboard widgets */

function wpse_73561_remove_all_dashboard_meta_boxes()
{
    global $wp_meta_boxes;
    $wp_meta_boxes['dashboard']['normal']['core'] = array();
    $wp_meta_boxes['dashboard']['side']['core'] = array();
}
add_action('wp_dashboard_setup', 'wpse_73561_remove_all_dashboard_meta_boxes', 9999 );

function add_dashboard_tutorial_widgets() {
    $widgets = array(
        array(
            'slug' => 'ftek_welcome',
            'title' => __('Welcome to the ftek admin!', 'ftek'),
            'position' => 'normal',
        ),
        array(
            'slug' => 'ftek_guidelines',
            'title' => __('Guidelines – read before posting!', 'ftek'),
            'position' => 'side',
        ),
        array(
            'slug' => 'howto_news',
            'title' => __('How to write a news item', 'ftek'), 
            'position' => 'normal',
        ),
        array(
            'slug' => 'howto_event',
            'title' => __("How to create an event", 'ftek'),
            'position' => 'normal',
        ),
        array(
            'slug' => 'howto_edit_page',
            'title' => __("How to edit your club's page", 'ftek'),
            'position' => 'normal',
        ),
        array(
            'slug' => 'howto_subpage',
            'title' => __("How to add a subpage to your club's page", 'ftek'),
            'position' => 'normal',
        ),
        array(
            'slug' => 'howto_course_pages',
            'title' => __("How to edit course pages", 'ftek'),
            'position' => 'normal',
            'capability' => 'edit_others_course_pages',
        ),
        array(
            'slug' => 'howto_menus',
            'title' => __('How to edit the menus', 'ftek'),
            'position' => 'side',
            'capability' => 'edit_theme_options',
        ),
        array(
            'slug' => 'howto_widgets',
            'title' => __('How to edit widgets', 'ftek'),
            'position' => 'side',
            'capability' => 'edit_theme_options',
        ),
        array(
            'slug' => 'howto_change_roles',
            'title' => __('How to change users roles', 'ftek'),
            'position' => 'side',
            'capability' => 'promote_users',
        ),
    );
        foreach ($widgets as $widget) {
            $cap = $widget['capability'];
            if( !$cap or current_user_can($cap) ) {
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
function ftek_welcome() {
    ?>
    <p>Här kan du:</p>
    <ul style="list-style: disc; margin-left: 1.5em;">
        <li>Skriva nyheter (inlägg)</li>
        <li>Skapa evenemang i kalendern</li>
        <li>Redigera din förenings sida</li>
        <li>Redigera din profil (namn, smeknamn, bild)</li>
        <?php if (current_user_can('edit_others_course_pages')):?>
        <li>Uppdatera kurssidor (fixa länkar, ladda upp tentor)</li>
        <?php endif;?>
        <?php if (current_user_can('promote_users')):?>
        <li>Ställa in roller (och därmed befogenheter) för andra användare</li>
        <?php endif;?>
        <?php if (current_user_can('edit_theme_options')):?>
        <li>Redigera menyer och widgets</li>
        <?php endif;?>
        <?php if (current_user_can('manage_options')):?>
        <li>Ändra inställningar för hemsidan (var försiktig!)</li>
        <?php endif;?>
    </ul>
    <p>På den här sidan finns guider som hjälper dig göra detta, även om det mesta borde gå lätt. Gå tillbaka hit om du undrar något. Lycka till!</p>
    <?php
}

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
        <li>Gå in på <em>Inlägg &rarr; Skapa nytt</em></li>
        <li>Fyll i rubrik och text.</li>
        <li>Om nyheten är lång, sammanfatta den i första stycket och lägg sedan en <em>läs mer</em>-länk innan resten av texten.</li> 
        <li>Välj relevanta kategorier. Ska nyheten synas på framsidan, välj kategorin <em>Framsida</em>.</li>
        <li>Välj en <em>utvald bild</em> och beskär den vettigt.</li>
        <li>Om det är relevant, välj ett evenemang att koppla nyheten till.</li>
        <li>Om det är relevant, fyll i engelsk rubrik och text.</li>
    </ol>
    <?php
} 

function howto_event() {
    ?>
    <ol>
        <li>Gå in på <em>Evenemang &rarr; Skapa nytt</em></li>
        <li>Fyll i rubrik och en kort beskrivning.</li>
        <li>Välj tid och plats. Finns inte platsen bland de befintliga, skapa en ny.</li>
        <li>Välj relevanta kategorier. Spamma inte.</li>
        <li>Om du vill, välj en <em>utvald bild</em> och beskär den vettigt.</li>
        <li>Om det är relevant, fyll i engelsk rubrik och beskrivning.</li>
    </ol>
    <?php
}

function howto_edit_page() {
    ?>
    <ol>
        <li>Gå in på <em>Sidor</em> och hitta din förenings sida eller relevant undersida.</li>
        <li>Titta på hur tidigare år har gjort och uppdatera det som är relevant.</li>
    </ol>
    <?php
}

function howto_subpage() {
    ?>
    <ol>
        <li>Gå in på <em>Sidor &rarr; Skapa ny</em></li>
        <li>Fyll i sidnamn och innehåll på både svenska och engelska.</li>
        <li>Välj din förenings huvudsida som föräldersida.</li>
        <li>Om du vill, välj en specifik <em>utvald bild</em> för undersidan och beskär den vettigt. Om du inte väljer en specifik bild används samma som på föreningens huvudsida.</li>
    </ol>
    <?php
}

function howto_course_pages() {
    ?>
    <ol>
        <li>Gå in på Kurssidor och välj kursens sida. Finns den inte, välj <em>skapa ny</em>.</li>
        <li>Uppdatera och fyll i så mycket information du kan.</li>
        <li>Om startsidan visar fel kurser, uppdatera läsperiodtiderna under <em>Inställningar &rarr; Ftek kurssidor</em>.</li>
    </ol>
    <?php
}

function howto_menus()
{
    ?>
    <ol>
        <li>Gå in på: <em>Utseende &rarr; Menyer</em></li>
        <li>Välj den meny du vill redigera högst upp.</li>
        <li>Lägg till menyelement till vänster, redigera till höger.</li>
        <li>För att redigera detaljerna för ett menyelement, klicka på den lilla triangeln till höger på elementets "låda".</li>
        <li>För att ge ett menyelement en beskrivande text, använd <em>titelattribut</em>-fältet såhär: <br/><code>[:sv]Svensk text[:en]English text</code></li>
    </ol>
    <?php
}

function howto_widgets()
{
    ?>
    <ol>
        <li>Gå in på: <em>Utseende &rarr; Widgets</em></li>
        <li>Redigera widgets till höger genom att klicka på dem.</li>
        <li>Lägg till nya widgets tillvänster genom att klicka på dem.</li>
        <li>För att det du skriver ska vara tillgängligt på både svenska och engelska, fyll i alla textfält såhär: <br/><code>[:sv]Svensk text[:en]English text</code></li>
    </ol>
    <?php
}

function howto_change_roles()
{
    ?>
    <ol>
        <li>Gå in på: <em>Användare &rarr; Alla användare</em>.</li>
        <li>Markera de användare vars roll du vill ändra.</li>
        <li>Välj roll från listan <em>Ändra roll till</em> och klicka på ändra.</li>
    </ol>
    <p>I ordning från mest befogenheter till minst:</p>
    <ol>
        <li>Styret</li>
        <li>SNF</li>
        <li>Sektionsaktiv</li>
        <li>Sektionsmedlem</li>
    </ol>
    <?php
}

/* Simplify editing interface */

if (is_admin()) :
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
endif;
