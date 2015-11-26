<script>
$(document).ready(function () {
    // Get current URL from canonical tag
    var shareUrl = window.location.href;

    // Ajax request to read share counts. Notice "&callback=?" is appended to the URL to define it as JSONP.
    $.getJSON('https://count.donreach.com/?url=' + encodeURIComponent(shareUrl) + "&callback=?", function (data) {
        shares = data.shares;
        shares.total = data.total;
        $(".count").each(function (index, el) {
            service = $(el).parents(".share-btn").attr("data-service");
            count = shares[service];

            // Divide large numbers eg. 5500 becomes 5.5k
            if (count > 1000) {
                count = (count / 1000).toFixed(1);
                if (count > 1000) count = (count / 1000).toFixed(1) + "M";
                else count = count + "k";
            }
            if(count == null){
                count = 0;
            }
            $(el).html(count);
        });
    });
});
</script>
@if (isset($programKerja))    
    {!! $title = $programKerja->present('name') !!} 
@endif      
@if (isset($usulanProker))    
    {!! $title = $usulanProker->present('name') !!} 
@endif 
@if (isset($ujiPublik))   
    {!! $title = $ujiPublik->present('name') !!} 
@endif 
<div class="don-share" data-title="{{ $title }}"  data-image="" data-style="icons" data-bubbles="none">

    <div class='share-btn' data-service="facebook">
        <div class="count"></div> <a class="don-share-facebook"></a>
    </div>
    <div class='share-btn' data-service="twitter">
        <div class="count"></div> <a class="don-share-twitter"></a>
    </div>
    <div class='share-btn' data-service="google">
        <div class="count"></div> <a class="don-share-google"></a>
    </div>

</div>