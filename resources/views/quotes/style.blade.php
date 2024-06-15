<style>
    @media print {
        /*div, p, hr {*/
        /*    display: none !important;*/
        /*}*/
        hr {
            display: none !important;
        }
    }

    @if($breakOnTables)
    table {
        page-break-after: always;
    }

    table:last-child {
        page-break-after: unset !important;
    }
    @endif

    table {
        width: 100%;
        text-align: center;
        font-family: "Open Sans";
        font-size: 16px;
        color: #666666;
        border-collapse: collapse;
        border-color: #C3907D;
    }

    td, th {
        padding: 8px;
        line-height: 1.1em;
    }
</style>