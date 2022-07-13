
@extends('layouts/layoutMaster')

@section('title', 'ข้อมูลกรมควบคุมมลพิษ')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/leaflet/leaflet.css')}}" />

@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
<script src="{{asset('assets/vendor/libs/leaflet/leaflet.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
<script>
 var geojson_data;
$.ajax({
  url: "https://raw.githubusercontent.com/apisit/thailand.json/master/thailandwithdensity.json",
  method: "GET",
  async: false,
  success : function(data){
    geojson_data = JSON.parse(data);
  }
});

var map = L.map('mapid').setView([13, 101.5], 5);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// control that shows state info on hover
var info = L.control();

info.onAdd = function (map) {
  this._div = L.DomUtil.create('div', 'info');
  this.update();
  return this._div;
};

info.update = function (props) {
  this._div.innerHTML = '<h4>ความหนาแน่นของประชากรไทย</h4>' +
    (props ? '<b>' + props.name + '</b><br />' + props.p + ' คน / กม.<sup>2</sup>' : 'ชี้ที่จังหวัด');
};

info.addTo(map);

function getColor(d) {
  return  d > 1000 ? '#800026' :
  d > 500  ? '#BD0026' :
  d > 200  ? '#E31A1C' :
  d > 100  ? '#FC4E2A' :
  d > 50   ? '#FD8D3C' :
  d > 20   ? '#FEB24C' :
  d > 10   ? '#FED976' :
  '#FFEDA0';
}

function style(feature) {
  return {
    fillColor: getColor(feature.properties.p),
    weight: 1,
    opacity: 1,
    color: 'white',
    dashArray: '3',
    fillOpacity: 0.7
  };
}

function highlightFeature(e) {
  var layer = e.target;
  layer.setStyle({
    weight: 5,
    color: '#666',
    dashArray: '',
    fillOpacity: 0.7
  });
  if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
    layer.bringToFront();
  }
  info.update(layer.feature.properties);
}

var geojson;

function resetHighlight(e) {
  geojson.resetStyle(e.target);
  info.update();
}

function zoomToFeature(e) {
  map.fitBounds(e.target.getBounds());
}

function onEachFeature(feature, layer) {
  layer.on({
    mouseover: highlightFeature,
    mouseout: resetHighlight,
    click: zoomToFeature
  });
}

geojson = L.geoJson(geojson_data, {
  style: style,
  onEachFeature: onEachFeature
}).addTo(map);

var legend = L.control({position: 'bottomright'});

legend.onAdd = function (map) {
  var div = L.DomUtil.create('div', 'info legend'),
      grades = [0, 10, 20, 50, 100, 200, 500, 1000],
      labels = [],
      from, to;
  for (var i = 0; i < grades.length; i++) {
    from = grades[i];
    to = grades[i + 1];
    labels.push(
      '<i style="background:' + getColor(from + 1) + '"></i> ' +
      from + (to ? '&ndash;' + to : '+'));
  }
  div.innerHTML = labels.join('<br>');
  return div;
};

legend.addTo(map);

</script>
@endsection







@section('content')
<div class="row">



  <div class="col-lg-6 col-md-6 col-12 mb-4">
    <div class="card h-100">
      <div class="card-header">
        <h5 class="card-title mb-2">ข้อมูลทั้งหมด</h5>
        <h1 class="display-6 fw-normal mb-0">8,634,820</h1>
      </div>
      <div class="card-body">
        <span class="d-block mb-2">พื้นที่ข้อมูล</span>
        <div class="progress progress-stacked mb-3 mb-xl-5" style="height:8px;">
          <div class="progress-bar bg-success" role="progressbar" style="width: 56%" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100"></div>
          <div class="progress-bar bg-danger" role="progressbar" style="width: 26%" aria-valuenow="26" aria-valuemin="0" aria-valuemax="100"></div>
          <div class="progress-bar bg-info" role="progressbar" style="width: 18%" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100"></div>

        </div>
        <ul class="p-0 m-0">
          <li class="mb-3 d-flex justify-content-between">
            <div class="d-flex align-items-center lh-1 me-3">
              <span class="badge badge-dot bg-success me-2"></span> การจัดการคุณภาพน้ำ
            </div>
            <div class="d-flex gap-3">

              <span class="fw-semibold">56%</span>
            </div>
          </li>
          <li class="mb-3 d-flex justify-content-between">
            <div class="d-flex align-items-center lh-1 me-3">
              <span class="badge badge-dot bg-danger me-2"></span> การจัดการคุณภาพอากาศ
            </div>
            <div class="d-flex gap-3">

              <span class="fw-semibold">26%</span>
            </div>
          </li>
          <li class="mb-3 d-flex justify-content-between">
            <div class="d-flex align-items-center lh-1 me-3">
              <span class="badge badge-dot bg-info me-2"></span> การจัดการกากของเสียและสารอันตราย
            </div>
            <div class="d-flex gap-3">

              <span class="fw-semibold">18%</span>
            </div>
          </li>

        </ul>
      </div>
    </div>
  </div>
  <!--/ All Users -->


  <div class="col-lg-6 col-12">
    <div class="row">
      <!-- Statistics Cards -->
      <div class="col-6 col-md-3 col-lg-6 mb-4">
        <div class="card h-100">
          <div class="card-body text-center">
            <div class="avatar mx-auto mb-2">
              <span class="avatar-initial rounded-circle bg-label-success"><i class="bx bx-buildings fs-4"></i></span>
            </div>
            <span class="d-block text-nowrap">หน่วยงานที่เชื่อมโยง</span>
            <h2 class="mb-0">3</h2>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-3 col-lg-6 mb-4">
        <div class="card h-100">
          <div class="card-body text-center">
            <div class="avatar mx-auto mb-2">
              <span class="avatar-initial rounded-circle bg-label-warning"><i class="bx bxs-report fs-4"></i></span>
            </div>
            <span class="d-block text-nowrap">รายงาน</span>
            <h2 class="mb-0">40</h2>
          </div>
        </div>
      </div>
      <!--/ Statistics Cards -->
      <!-- Revenue Growth Chart -->
      <div class="col-12 col-md-6 col-lg-12 mb-4">
        <div class="card">
          <div class="card-header pb-2">
            <h5 class="card-title mb-0">การลงทะเบียน</h5>
          </div>
          <div class="card-body pb-2">
            <div class="d-flex justify-content-between align-items-end gap-3">
              <div class="mb-3">
                <div class="d-flex align-content-center">
                  <h5 class="mb-1">58.4k</h5>
                  <i class="bx bx-chevron-up text-success"></i>
                </div>
                <small class="text-success">12.8%</small>
              </div>
              <div id="registrationsBarChart"></div>
            </div>
          </div>
        </div>

      </div>
      <!--/ Revenue Growth Chart -->
    </div>
  </div>




    <div class="col-12 col-md-12 col-lg-12 mb-4">
      <div class="card">
        <div class="card-header pb-2">
          <h5 class="card-title mb-0 ">แผนที่แบ่งเขตจังหวัด</h5>
        </div>
        <div class="card-body pb-2">
          <div class="leaflet-map" id="mapid"></div>
        </div>
      </div>
    </div>



</div>
<div class="row">
  <!-- Website Analytics-->
  <div class="col-lg-6 col-md-12 mb-4">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">ข้อมูลขยะ</h5>

      </div>
      <div class="card-body pb-2">
        <div class="d-flex justify-content-around align-items-center flex-wrap mb-4">
          <div class="user-analytics text-center me-2">
            <i class="bx bx-trash me-1"></i>
            <span>ขยะ</span>
            <div class="d-flex align-items-center mt-2">
              <div class="chart-report" data-color="success" data-series="35"></div>
              <h3 class="mb-0">61K</h3>
            </div>
          </div>
          <div class="sessions-analytics text-center me-2">
            <i class="bx bx-pie-chart-alt me-1"></i>
            <span>ระยะเวลา</span>
            <div class="d-flex align-items-center mt-2">
              <div class="chart-report" data-color="warning" data-series="76"></div>
              <h3 class="mb-0">92K</h3>
            </div>
          </div>
          <div class="bounce-rate-analytics text-center">
            <i class="bx bx-trending-up me-1"></i>
            <span>Bounce Rate</span>
            <div class="d-flex align-items-center mt-2">
              <div class="chart-report" data-color="danger" data-series="65"></div>
              <h3 class="mb-0">72.6%</h3>
            </div>
          </div>
        </div>
        <div id="analyticsBarChart"></div>
      </div>
    </div>

  </div>

  <!-- Referral, conversion, impression & income charts -->
  <div class="col-lg-6 col-md-12">
    <div class="row">
      <!-- Referral Chart-->
      <div class="col-sm-6 col-12 mb-4">
        <div class="card">
          <div class="card-body text-center">
            <h2 class="mb-1">32,690</h2>
            <span class="text-muted">อัตราค่าใช้จ่าย 40%</span>
            <div id="referralLineChart"></div>
          </div>
        </div>
      </div>
      <!-- Conversion Chart-->
      <div class="col-sm-6 col-12 mb-4">
        <div class="card">
          <div class="card-header d-flex justify-content-between pb-3">
            <div class="conversion-title">
              <h5 class="card-title mb-1">ความสำเร็จ</h5>
              <p class="mb-0 text-muted">60%
                <i class="bx bx-chevron-up text-success"></i>
              </p>
            </div>
            <h2 class="mb-0">89k</h2>
          </div>
          <div class="card-body">
            <div id="conversionBarchart"></div>
          </div>
        </div>
      </div>
      <!-- Impression Radial Chart-->
      <div class="col-sm-6 col-12 mb-4">
        <div class="card">
          <div class="card-body text-center">
            <div id="impressionDonutChart"></div>
          </div>
        </div>
      </div>
      <!-- Growth Chart-->
      <div class="col-sm-6 col-12">
        <div class="row">
          <div class="col-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <div class="d-flex align-items-center gap-3">
                    <div class="avatar">
                      <span class="avatar-initial bg-label-primary rounded-circle"><i class="bx bx-user fs-4"></i></span>
                    </div>
                    <div class="card-info">
                      <h5 class="card-title mb-0 me-2">$38,566</h5>
                      <small class="text-muted">รายจ่าย</small>
                    </div>
                  </div>
                  <div id="conversationChart"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <div class="d-flex align-items-center gap-3">
                    <div class="avatar">
                      <span class="avatar-initial bg-label-warning rounded-circle"><i class="bx bx-dollar fs-4"></i></span>
                    </div>
                    <div class="card-info">
                      <h5 class="card-title mb-0 me-2">$53,659</h5>
                      <small class="text-muted">งบประมาณ</small>
                    </div>
                  </div>
                  <div id="incomeChart"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Referral, conversion, impression & income charts -->

  <!-- Activity -->

  <!--/ Activity Timeline -->
</div>
@endsection
