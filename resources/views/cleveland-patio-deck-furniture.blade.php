@extends('layout')

@section('keywords') furniture, patio, deck, hearth, cleveland, ohio, northeast, ohio, cuyahoga, geauga, lake, portage, akron, outdoor furniture, wicker furniture, wicker, outdoor, chairs, ratton @stop

@section('title') Patio, Deck & Hearth Shop: - Perfect Patios and Decks - Outdoor Furniture in Cleveland @stop

@section('content')

    <div class="page_content_offset outdoor-cleveland">
        <div class="container">
            <?php
            if (isset($PATH_INFO)) {
                $vardata   = explode('/', $_SERVER['PATH_INFO']);
                $num_param = count($vardata);
                if ($num_param % 2 == 0) {
                    $vardata[] = '';
                    $num_param++;
                }
                for ($i = 1; $i < $num_param; $i += 2) {
                    if ( ! empty($vardata[$i]) AND ! empty($vardata[$i + 1])) {
                        $$vardata[$i] = addslashes($vardata[$i + 1]);
                    }
                }
            }

            $xml = simplexml_load_file("xml/perfect-patios-decks.xml");

            foreach ($xml->Gallery as $Gallery) {
                if ($Gallery->ID == $page) {
                    $GalleryTitle       = $Gallery->Title;
                    $GalleryDescription = $Gallery->Description;
                    $GalleryPhotos      = $Gallery->Photos->Photo;
                }
            }
            echo $GalleryTitle;

            $keywords = "furniture, patio, deck, hearth, cleveland, ohio, northeast, ohio, cuyahoga, geauga, lake, portage, akron, outdoor furniture, wicker furniture, wicker, outdoor, chairs, ratton";
            $title = "Patio, Deck & Hearth Shop: " . $GalleryTitle . " - Perfect Patios and Decks near Cleveland";

            $includeShadowboxJS = true;
            include("includes/header.php");

            ?>

                    <!--begin main body table-->
            <table id="main" border="0" cellspacing="0">
                <tr>
                    <td id="patiohomelogo" colspan="3">
                        <div id="header_menu">
                            <a href="<?=$url;?>about-patio-deck-hearth-furniture.php">about</a> |
                            <a href="<?=$url;?>visit-patio-deck-hearth-furniture.php">visit</a> |
                            <a href="<?=$url;?>contact.php">contact</a>
                        </div>
                        <a href="<?=$url;?>index.php"><img id="patiohome" src="<?=$url;?>images/patio_header.gif"
                                                           width="733" height="52" alt="Patio Deck and Hearth Shop"></a>

                    </td>
                </tr>

                <!--end header section-->

                <!--end header section-->
                <!--begin cell for left side which includes menu-->
                <tr>
                    <td height="10"></td>
                </tr>

                <tr>
                    <td id="leftcell" valign="top" height="100%">
                        <!--table which should be 100% length-->
                        <!--begin table for menu which includes background-->
                        <table border="0" cellspacing="0">
                            <tr>
                                <td width="200" valign="top" height="100%" id="menucell">
                                    <!--begin menu table-->
                                    <? include("includes/menu.php");?>
                                            <!--end menu table-->
                                </td>
                            </tr>
                        </table>
                        <!--table which should be 100% length-->
                        <!--end table which includes background-->
                    </td>
                    <td id="maincell" colspan="2">
                        <!--begin main text header-->
                        <table cellspacing="0">
                            <tr>
                                <td id="mheader" style="width:440px;"><h2>PERFECT PATIOS & DECKS IN CLEVELAND</h2></td>
                            </tr>
                            <tr>
                                <td id="umheader"><h1><?php echo $GalleryTitle; ?></h1></td>
                            </tr>
                        </table>
                        <!--end main header-->
                        <br>
                        <!--main text-->
                        <table cellpadding="0">
                            <tr>
                                <td id="maintext"><b><?php echo $GalleryDescription; ?></b><br/><br/>

                                    <?php
                                    if ($GalleryPhotos) {
                                        echo 'Click on any photo to view larger image.<br><br>';
                                    } else {
                                        echo '<b>This gallery has been moved.  Please choose another gallery from the list below.<br/><br/></b>';
                                    }
                                    ?>
                                            <!--begin image table-->
                                    <table id='imgtable' cellspacing='0' border='0'>
                                        <?

                                        if ($GalleryPhotos) {

                                        foreach ($GalleryPhotos as $Photo) {
                                        $FileName = 'IMG_' . $Photo . '.jpg';
                                        @list($thumbwidth, $thumbheight, $thumbtype, $thumbattr) =
                                        getimagesize("images/perfect-patios-decks/thumbnails/$FileName");
                                        @list($fullwidth, $fullheight, $fulltype, $fullattr) =
                                        getimagesize("images/perfect-patios-decks/fullsized/$FileName");

                                        if ($count % 2 == 0) echo("
                                        <tr>");
                                            ?>
                                            <td valign="top" width="219" class="prodTd">
                                                <a href="<? echo $url;?>images/perfect-patios-decks/fullsized/<? echo $FileName;?>"
                                                   rel="shadowbox" border="0" id="prodimages" width="219"
                                                   height="<? echo $fullheight;?>">
                                                    <img src="<? echo $url;?>images/perfect-patios-decks/thumbnails/<? echo $FileName;?>"
                                                         rel="shadowbox" id="prodimages" width="219"
                                                         height="<? echo $thumbheight;?>"></a><br>
                                                <p><br>
                                            </td><?php
                                        if ($count % 2 == 1) echo("</tr>");
                                        $count++;
                                        }
                                        }

                                        ?>
                                    </table>
                                    <!--end image table-->
                                    <b>View more Perfect Patios & Decks:</b>
                                    <table cellspacing='0' cellpadding='0'>
                                        <?php
                                        $count = 0;


                                        foreach ($xml->Gallery as $Gallery) {
                                            if ($count % 2 == 0) echo("<tr>");
                                            echo '<td valign="top" width="219" class="prodTd" style="color: #492201;"><span style="font-family: Georgia,Arial,Verdana,Helvetica,sans-serif; font-size: 13px;">';
                                            if ($Gallery->ID != $page) {
                                                echo '<a href=' . $url . 'cleveland-patio-deck-furniture.php/page/' . $Gallery->ID . '/' . $Gallery->KeywordsForURL . '>' . $Gallery->Title . '</a>';
                                            } else {
                                                echo $Gallery->Title;
                                            }
                                            echo '</span></td>';
                                            if ($count % 2 == 1) echo("</tr>");
                                            $count++;
                                        }
                                        ?>
                                    </table>
                                    <br><br>
                                    <!--BEGIN  BOTTOM INFO-->
                                    <table cellspacing="0">
                                        <tr>
                                            <td>&nbsp;&nbsp;</td>
                                            <td id="binfoheader">MORE STYLES ON DISPLAY IN OUR SHOWROOM</td>
                                        </tr>
                                    </table>
                                    <table cellspacing="0">
                                        <tr>
                                            <td id="binfo" style="color: #492201;">Patio, Deck & Hearth Shop is one of
                                                the leading outdoor furniture and fireplace stores
                                                in Cleveland, Ohio. We take pride in our highly experienced and
                                                knowledgeable
                                                staff, our unique and extensive selection, and our reputation for
                                                standing behind the
                                                quality furniture we sell. Please stop by and see our showroom today.
                                                <br><br>
                                                <b><a href="<? echo $url;?>visit-patio-deck-hearth-furniture.php">Click
                                                        here</a> for hours and directions to our showroom or call (440)
                                                    564-2290.</b></td>
                                        </tr>
                                    </table>
                                    <!--END BOTTOM INFO-->

                                </td>
                            </tr>
                        </table>
                        <!--end main text-->
                    </td>
                </tr>
                <tr>
                    <td colspan="3" height="8"></td>
                </tr>
            </table>
        </div>
    </div>

@stop
