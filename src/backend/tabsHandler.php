<?php
class tabsHandler
{
    function showHotels($city, $country) //calls showHotels javascript function below
    {
        $booking_URL = "https://www.booking.com/searchresults.en-gb.html?aid=356980&label=gog235jc-1FCAMoUEIRYXNodG9uLXVuZGVyLWx5bmVICVgDaHGIAQGYAQm4ARfIAQzYAQHoAQH4AQKIAgGoAgO4AtvnlJoGwAIB0gIkMTA1YjA1ZTctYThiOS00NGJlLTg1OGQtOGEwM2M1ZjY5NjYw2AIF4AIB&lang=en-gb&sid=bc7ff1bd94c70d3074accc02eed88354&sb=1&sb_lp=1&src=index&src_elem=sb&error_url=https%3A%2F%2Fwww.booking.com%2Findex.en-gb.html%3Faid%3D356980%26label%3Dgog235jc-1FCAMoUEIRYXNodG9uLXVuZGVyLWx5bmVICVgDaHGIAQGYAQm4ARfIAQzYAQHoAQH4AQKIAgGoAgO4AtvnlJoGwAIB0gIkMTA1YjA1ZTctYThiOS00NGJlLTg1OGQtOGEwM2M1ZjY5NjYw2AIF4AIB%26sid%3Dbc7ff1bd94c70d3074accc02eed88354%26sb_price_type%3Dtotal%26%26&ss=" . $city . "&is_ski_area=0&checkin_year=&checkin_month=&checkout_year=&checkout_month=&group_adults=2&group_children=0&no_rooms=1&b_h4u_keep_filters=&from_sf=1&dest_id=&dest_type=&search_pageview_id=ef9e491fbdb90073&search_selected=false";
        echo '<script type="text/javascript"> ';
        echo 'showHotels("' . $booking_URL . '");';
        echo '</script>';
    }
    function showMaps($maps_URL) //calls showMaps javascript function below
    {
        echo '<script type="text/javascript"> ';
        echo 'showMaps("' . $maps_URL . '");';
        echo '</script>';
    }
    function runEverything($city, $country, $maps_URL)
    {
        $this->showHotels($city, $country);
        $this->showMaps($maps_URL);
    }
}
?>
<script>
    function showHotels(booking_URL) {
        window.open(booking_URL, "_blank");
    }

    function showMaps(maps_URL) {
        window.open(maps_URL, "_blank");
    }
</script>