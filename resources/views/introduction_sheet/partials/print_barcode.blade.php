
<style>
    @media print
    {
        @page
        {
            size:3in 1.5in;
        }
    }
</style>
@php
    echo DNS1D::getBarcodeSVG("$introductionSheet->car_barcode", 'C39', 1, 35)
@endphp
<script>
    window.print();
</script>
