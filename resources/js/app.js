import "./bootstrap"; // Assuming this is your Laravel Echo/Socket.IO setup or custom bootstrap file
import "../css/app.css"; // Your main CSS file

// Import Bootstrap (including Popper.js)
import "bootstrap/dist/js/bootstrap.bundle.min.js";
import "bootstrap/dist/css/bootstrap.min.css";

// Import Flowbite
import "flowbite";

import 'bootbox';
import bootbox from 'bootbox';
window.bootbox = bootbox;

import 'flowbite-datepicker';
import DateRangePicker from 'flowbite-datepicker/DateRangePicker';

import io from 'socket.io-client';
import html2pdf from 'html2pdf.js';
window.html2pdf = html2pdf;

import { Spinner } from 'spin.js';

window.createSpinner = function(target) {
    return new Spinner().spin(target);
};

import 'select2/dist/css/select2.css';
import select2 from 'select2';
select2();

// DataTables
import DataTable from "datatables.net-dt";
import "datatables.net-responsive-dt";
import "datatables.net-autofill-bs5";
import "datatables.net-buttons-bs5";
import "datatables.net-buttons/js/buttons.colVis.mjs";
import "datatables.net-buttons/js/buttons.html5.mjs";
import "datatables.net-buttons/js/buttons.print.mjs";
import "datatables.net-colreorder-bs5";
import DateTime from "datatables.net-datetime";
import "datatables.net-fixedcolumns-bs5";
import "datatables.net-fixedheader-bs5";
import "datatables.net-keytable-bs5";
import "datatables.net-responsive-bs5";
import "datatables.net-rowgroup-bs5";
import "datatables.net-rowreorder-bs5";
import "datatables.net-scroller-bs5";
import "datatables.net-searchbuilder-bs5";
import "datatables.net-searchpanes-bs5";
import "datatables.net-select-bs5";
import "datatables.net-staterestore-bs5";

// DataTables CSS
import "datatables.net-bs5/css/dataTables.bootstrap5.min.css";
import "datatables.net-autofill-bs5/css/autoFill.bootstrap5.min.css";
import "datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css";
import "datatables.net-colreorder-bs5/css/colReorder.bootstrap5.min.css";
import "datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css";
import "datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css";
import "datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css";
import "datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css";
import "datatables.net-rowgroup-bs5/css/rowGroup.bootstrap5.min.css";
import "datatables.net-rowreorder-bs5/css/rowReorder.bootstrap5.min.css";
import "datatables.net-scroller-bs5/css/scroller.bootstrap5.min.css";
import "datatables.net-searchbuilder-bs5/css/searchBuilder.bootstrap5.min.css";
import "datatables.net-searchpanes-bs5/css/searchPanes.bootstrap5.min.css";
import "datatables.net-select-bs5/css/select.bootstrap5.min.css";
import "datatables.net-staterestore-bs5/css/stateRestore.bootstrap5.min.css";

// Additional required libraries
import jszip from "jszip";
import pdfmake from "pdfmake";

pdfmake.fonts = {};


// Styles
import "normalize.css/normalize.css";
import "@fortawesome/fontawesome-free/css/all.min.css";

// Make DataTable globally available
window.DataTable = DataTable;
window.io = io;
window.html2pdf = html2pdf;




// Echo.channel("event-channel").listen("YourEventName", (e) => {
//     console.log(e.message);
