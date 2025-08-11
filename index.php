<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="YoIkc4bBr4HMTVCE0mT8tUfvbcyfI0xzAbtWc7DT">
    <title>Change Analysis Dashboard</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <!-- External Libraries -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/6b3a5661a9.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Chart.js for graphs -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Leaflet for maps -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" /> -->

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    
    <!-- Custom styleSheet -->
    <link rel="stylesheet" href="css/index.css">

</head>

<body>
    <!-- Loading Spinner -->
    <div class="loader" id="loader">
        <div class="spinner"></div>
    </div>

    <!-- Header -->
    <header class="header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-2">
                    <div class="logo-bg-container">
                        <img src="https://gis-lab.s3.ap-southeast-1.amazonaws.com/14efcc73-5a15-4fd6-98f9-052868aeb7eb_FWF_New_Logo.png" 
                             alt="Department Logo" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-8">
                    <h1 class="header-title">Forest Cover Change Analysis Dashboard</h1>
                </div>
                <div class="col-md-2 text-end">
                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Cg%3E%3Ctree stroke='%23228B22' stroke-width='2' fill='%2332CD32'%3E%3Cpath d='M20 80 Q30 60 40 80 Q50 50 60 80 Q70 60 80 80' fill='%23228B22'/%3E%3Cpath d='M45 80 L55 80 L55 90 L45 90 Z' fill='%238B4513'/%3E%3C/tree%3E%3Ctext x='50' y='95' text-anchor='middle' font-size='8' fill='%23333'%3EForestry%3C/text%3E%3C/g%3E%3C/svg%3E" 
                         alt="Forestry Icon" style="height: 50px;">
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Filter Section -->
        <section class="filter-section">
            <h2 class="filter-title">
                <i class="fas fa-filter me-2"></i>Analysis Filters
            </h2>
            <div class="row">
                <!-- In your filter section, update the dropdowns to show loading states -->
                <div class="col-lg-4 col-md-6 mb-3">
                    <label for="zoneSel" class="form-label">Zone</label>
                    <select id="zoneSel" class="form-select">
                        <option value="" selected>Select Zone</option>
                    </select>
                </div>
                <div class="col-lg-4 col-md-6 mb-3">
                    <label for="circleSel" class="form-label">Circle</label>
                    <select id="circleSel" class="form-select" disabled>
                        <option value="" selected>Select zone first</option>
                    </select>
                </div>
                <div class="col-lg-4 col-md-6 mb-3">
                    <label for="divisionSel" class="form-label">Division</label>
                    <select id="divisionSel" class="form-select" disabled>
                        <option value="" selected>Select circle first</option>
                    </select>
                </div>
                <!-- <div class="col-lg-3 col-md-6 mb-3">
                    <label for="forestSel" class="form-label">Forest</label>
                    <select id="forestSel" class="form-select" disabled>
                        <option value="" selected>Select division first</option>
                    </select>
                </div> -->
            </div>
        </section>

            <!-- Change Analysis Section -->
        <section class="analysis-section">
            <div class="analysis-header" onclick="toggleYearSelection()">
                <h3 class="analysis-title">
                    <i class="fas fa-chart-line me-2"></i>Change Analysis Configuration
                </h3>
                <i class="fas fa-chevron-down toggle-icon" id="toggleIcon"></i>
            </div>
            <div class="year-selection" id="yearSelection">
                <p class="text-muted mb-3">Select years to compare (available years will appear after selecting a Division):</p>
                <div class="year-checkboxes" id="yearCheckboxesContainer">
                    <!-- Dynamic content will be inserted here -->
                </div>
                <div class="action-buttons mt-3">
                    <button class="btn btn-custom btn-reset" onclick="resetYearSelection()">
                        <i class="fas fa-undo me-2"></i>Reset Year Selection
                    </button>
                </div>
            </div>
        </section>

        <!-- Map and Chart Container -->
        <section class="content-container">
            <!-- Map Container -->
            <div class="map-container">
                <h4 class="section-title">
                    <i class="fas fa-map me-2"></i>Geographic Overview
                </h4>
                <div id="map">
                    <div class="sidebar" id="spatialSidebar">
  <div class="sidebar-header" onclick="toggleSidebar()">
    <div class="sidebar-title" id="sidebarTitle">
      <i class="fas fa-chart-area"></i>
      <span>Change Analysis</span>
    </div>
    <i class="fas fa-chevron-down" id="chevronIcon"></i>
  </div>

  <div class="layer-btn" id="sidebarContent">
    <div class="year-checkboxes">
      <label>
  <input type="checkbox" value="2023" onchange="drawYearLayers(this.checked, this.value)">
  2023
</label>

<label>
  <input type="checkbox" value="2025" onchange="drawYearLayers(this.checked, this.value)">
  2025
</label>


    </div>
  </div>
</div>
                </div>
                
            </div>

            <!-- Chart Container -->
            <div class="chart-container">
                <h4 class="section-title">
                    <i class="fas fa-chart-pie me-2"></i>Forest Cover Change
                </h4>
                <div class="chart-wrapper">
                    <canvas id="lulcChart"></canvas>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p>© GIS Lab, Forestry Wildlife and Fisheries Department, Lahore - Government of the Punjab.<br>
        All rights reserved.</p>
    </footer>

    <script>

      // Global variables
        let map;
        const cachedYearData = {};  // To store API data per division
        cachedYearDataStat = {};
        let yearData;
        let currentLayers = {
            zone: null,
            circle: null,
            division: null,
            forest: null,
            year23: null,
            year25: null
        };
        let availableYears = [];
        let selectedYears = [];
        let selectedForestId = null;
        let lulcChart;
        const API_BASE_URL = './spatialAPIs/'; // Update this path as needed
        const STATS_API_BASE_URL = './statsAPIs/'; // Update this path as needed

        document.addEventListener('DOMContentLoaded', function() {
            initializeMap();
            initializeLULCChart();
            //initializeYearCheckboxes();
            setupEventListeners();
            loadZones();
            //loadAllLULCStats();
        });

// -----------------------------MAP PART---------------------------

function initializeMap() {
    // Create map centered on Lahore
    map = L.map('map').setView([31.5204, 74.3587], 8);

    // OpenStreetMap base layer
    const osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    });

    // Google Satellite
    const satellite = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
        attribution: '© Google'
    });

    // Google Streets (default road map)
    const street = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
        attribution: '© Google'
    });

    // Google Hybrid (labels + satellite)
    const hybrid = L.tileLayer('http://{s}.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
        attribution: '© Google'
    });

    // Base layers
    const baseMaps = {
        "Open Street Map": osm,
        "Google Streets": street,
        "Google Satellite": satellite,
        "Google Hybrid": hybrid
    };

    // Add default layer to map
    osm.addTo(map);

    // Add layer control
    L.control.layers(baseMaps).addTo(map);


      // 3. Create legend control
  const legend = L.control({ position: 'bottomright' });

  legend.onAdd = function () {
    const div = L.DomUtil.create('div', 'info legend');

    for (const landClass in classColors) {
      const color = classColors[landClass];
      div.innerHTML +=
        `<i style="background:${color}; width:12px; height:12px; display:inline-block; margin-right:6px;"></i>${landClass}<br>`;
    }

    return div;
  };

  // 4. Add legend after map is created
  legend.addTo(map);
}

function toggleSidebar() {
    const sidebar = document.getElementById('spatialSidebar');
    const icon = document.getElementById('chevronIcon');

    sidebar.classList.toggle('collapsed');

    if (sidebar.classList.contains('collapsed')) {
      icon.classList.remove('fa-chevron-down');
      icon.classList.add('fa-chevron-up');
    } else {
      icon.classList.remove('fa-chevron-up');
      icon.classList.add('fa-chevron-down');
    }
  }


  //draw 2023 layer 

 function drawYearLayers(checked, year) {
    const division = document.getElementById('divisionSel').value;
  if (checked) {
    if (cachedYearData[division] && cachedYearDataStat[division]) {
      createYearLayers(cachedYearData[division], year);
      updateChart(cachedYearDataStat[division], year);
    } else {
      getChangeAnalysisData(division).then(data => {
        cachedYearData[division] = data;
        createYearLayers(data, year);
      });

      loadNumberStat(division).then(response => {
  if (response.status === "success") {
    const stats = response.data;  // ✅ Extract the `data` part
    cachedYearDataStat[division] = stats;
    console.log(stats);
    updateChart(stats, year);  // ✅ Now correct structure
  } else {
    console.error("Failed to load stats:", response);
  }
});

    }
  } else {
    removeYearLayers(year);
  }
}



const classColors = {
   "Tree Cover": "#009600CC",
  "Agriland/Grass": "#FFFF00F0",
  "Water": "#0000FFCC",
  "Barren Land": "#A0522DCC",
  "Builtup": "#FF0000CC",
  
  
};

function createYearLayers(yearData, year) {
  const filteredData = yearData.data.filter(item => item.year === year.toString());

  filteredData.forEach(item => {
    const safeClass = item.class.replace(/\s+/g, "_"); // Clean class names
    const layerKey = `year${year}_${safeClass}`;

    if (currentLayers[layerKey]) return; // Already exists, skip

    const geoJsonFeature = {
      type: "Feature",
      geometry: JSON.parse(item.geom),
      properties: {
        class: item.class,
        division: item.forest_division
      }
    };

    const color = classColors[item.class] || '#000000';

    const layer = L.geoJSON(geoJsonFeature, {
      style: {
        color: color,
        weight: 2,
        fillOpacity: 0.9
      }
    }).addTo(map);

    currentLayers[layerKey] = layer;
  });
}


function removeYearLayers(year) {
  const keysToRemove = Object.keys(currentLayers).filter(key => key.startsWith(`year${year}_`));

  keysToRemove.forEach(key => {
    map.removeLayer(currentLayers[key]);
    delete currentLayers[key];
  });
}


// Load zones from API
function loadZones() {
    showLoader();
    fetch(API_BASE_URL + 'fetch_zones.php')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const zoneDropdown = document.getElementById('zoneSel');
                // Clear existing options except the first one
                while (zoneDropdown.options.length > 1) {
                    zoneDropdown.remove(1);
                }
                data.data.forEach(zone => {
                    const option = document.createElement('option');
                    option.value = zone;
                    option.textContent = zone;
                    zoneDropdown.appendChild(option);
                });
            } else {
                console.error('Error loading zones:', data.message);
            }
            hideLoader();
        })
        .catch(error => {
            console.error('Error:', error);
            hideLoader();
        });
}

// Handle zone selection
function handleZoneSelection(zone) {
    const circleDropdown = document.getElementById('circleSel');
    const divisionDropdown = document.getElementById('divisionSel');
    //const forestDropdown = document.getElementById('forestSel');

    // Reset dependent dropdowns
    resetDropdown(circleDropdown, 'Select Circle');
    resetDropdown(divisionDropdown, 'Select Division');
    //resetDropdown(forestDropdown, 'Select Forest');

    if (zone) {
        // Enable circle dropdown and populate from API
        circleDropdown.disabled = false;
        loadCircles(zone);
        
        // Draw zone boundary on map
        drawZoneBoundary(zone);
    } else {
        circleDropdown.disabled = true;
        divisionDropdown.disabled = true;
        forestDropdown.disabled = true;
        clearMapLayers('zone');
    }
}

// Load circles for selected zone
function loadCircles(zone) {
    showLoader();
    fetch(`${API_BASE_URL}fetch_circles.php?forest_zone=${encodeURIComponent(zone)}`)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const circleDropdown = document.getElementById('circleSel');
                resetDropdown(circleDropdown, 'Select Circle');
                data.data.forEach(circle => {
                    const option = document.createElement('option');
                    option.value = circle;
                    option.textContent = circle;
                    circleDropdown.appendChild(option);
                });
            } else {
                console.error('Error loading circles:', data.message);
            }
            hideLoader();
        })
        .catch(error => {
            console.error('Error:', error);
            hideLoader();
        });
}

// Handle circle selection
function handleCircleSelection(circle) {
    const divisionDropdown = document.getElementById('divisionSel');
    //const forestDropdown = document.getElementById('forestSel');

    resetDropdown(divisionDropdown, 'Select Division');
    //resetDropdown(forestDropdown, 'Select Forest');

    if (circle) {
        divisionDropdown.disabled = false;
        loadDivisions(circle);
        drawCircleBoundary(circle);
    } else {
        divisionDropdown.disabled = true;
        forestDropdown.disabled = true;
        clearMapLayers('circle');
    }
}

// Load divisions for selected circle
function loadDivisions(circle) {
    showLoader();
    fetch(`${API_BASE_URL}fetch_divisions.php?forest_circle=${encodeURIComponent(circle)}`)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const divisionDropdown = document.getElementById('divisionSel');
                resetDropdown(divisionDropdown, 'Select Division');
                data.data.forEach(division => {
                    const option = document.createElement('option');
                    option.value = division;
                    option.textContent = division;
                    divisionDropdown.appendChild(option);
                });
            } else {
                console.error('Error loading divisions:', data.message);
            }
            hideLoader();
        })
        .catch(error => {
            console.error('Error:', error);
            hideLoader();
        });
}

// Handle division selection
function handleDivisionSelection(division) {
    const forestDropdown = document.getElementById('forestSel');

    //resetDropdown(forestDropdown, 'Select Forest');

    if (division) {
        //forestDropdown.disabled = false;
        //loadForests(division);
        // yearData = getChangeAnalysisData(division);
        // console.log(yearData)
        drawDivisionBoundary(division);
    } else {
        //forestDropdown.disabled = true;
        clearMapLayers('division');
    }
}

// Load forests for selected division
// function loadForests(division) {
//     showLoader();
//     fetch(`${API_BASE_URL}fetch_forests.php?forest_division=${encodeURIComponent(division)}`)
//         .then(response => response.json())
//         .then(data => {
//             if (data.status === 'success') {
//                 const forestDropdown = document.getElementById('forestSel');
//                 resetDropdown(forestDropdown, 'Select Forest');
//                 data.data.forEach(forest => {
//                     const option = document.createElement('option');
//                     option.value = forest.unique_id;
//                     option.textContent = forest.forest_name;
//                     forestDropdown.appendChild(option);
//                 });
//             } else {
//                 console.error('Error loading forests:', data.message);
//             }
//             hideLoader();
//         })
//         .catch(error => {
//             console.error('Error:', error);
//             hideLoader();
//         });
// }

// Draw zone boundary on map

function drawZoneBoundary(zone) {
    console.log(zone);

    showLoader();
    clearMapLayers('zone');

    fetch(`${API_BASE_URL}get_forest_zone.php`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ forest_zone: zone })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success' && data.data.length > 0) {
            console.log(data)
            const geoJson = {
                type: 'Feature',
                geometry: data.data[0].geometry,
                properties: {
                    name: data.data[0].forest_zone
                }
            };
            
            currentLayers.zone = L.geoJSON(geoJson, {
                style: {
                    color: '#FFA500',
                    weight: 3,
                    opacity: 1,
                    fillOpacity: 0.2
                }
            }).addTo(map);

            const bounds = currentLayers.zone.getBounds();
map.fitBounds(bounds, {
  padding: [10, 10],
  maxZoom: 18  // or 22 if your tile source supports it
});

        } else {
            console.error('Error loading zone boundary:', data.message);
        }
        hideLoader();
    })
    .catch(error => {
        console.error('Error:', error);
        hideLoader();
    });
// const geoJson = {
//     type: "Feature",
//     geometry: {
//         type: "Polygon",
//         coordinates: [[[74.3, 31.5], [74.4, 31.5], [74.4, 31.6], [74.3, 31.6], [74.3, 31.5]]]
//     },
//     properties: { name: "Test" }
// };

// console.log("geoJson", geoJson);
// const layer = L.geoJSON(geoJson);
// console.log("Created layer:", layer);

// if (layer) {
//     currentLayers.zone = layer.addTo(map);
//     map.fitBounds(currentLayers.zone.getBounds(), {
//         padding: [50, 50],
//         maxZoom: 10
//     });
// } else {
//     console.error("L.geoJSON returned undefined.");
// }

}

// function drawZoneBoundary(zone) {
//                 console.log(zone)

//     showLoader();
//     clearMapLayers('zone');
    
//     fetch(`${API_BASE_URL}get_forest_zone.php?forest_zone=${encodeURIComponent(zone)}`)
//         .then(response => response.json())
//         .then(data => {
//             if (data.status === 'success' && data.data.length > 0) {
//                 const geoJson = {
//                     type: 'Feature',
//                     geometry: data.data[0].geometry,
//                     properties: {
//                         name: data.data[0].forest_zone
//                     }
//                 };
//                 console.log("geoJson" + data)
                
//                 currentLayers.zone = L.geoJSON(geoJson, {
//                     style: {
//                         color: '#FFA500',
//                         weight: 3,
//                         opacity: 1,
//                         fillOpacity: 0.2
//                     }
//                 }).addTo(map);
                
//                 // Zoom to bounds with some padding and slightly higher zoom level
//                 const bounds = currentLayers.zone.getBounds();
//                 map.fitBounds(bounds, {
//                     padding: [50, 50], // Add some padding
//                     maxZoom: 10 // Set maximum zoom level
//                 });
//             } else {
//                 console.error('Error loading zone boundary:', data.message);
//             }
//             hideLoader();
//         })
//         .catch(error => {
//             console.error('Error:', error);
//             hideLoader();
//         });
// }

// Draw circle boundary on map
function drawCircleBoundary(circle) {
    showLoader();
    clearMapLayers('circle');
    
    fetch(`${API_BASE_URL}get_circle.php?forest_circle=${encodeURIComponent(circle)}`)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success' && data.data.length > 0) {
                const geoJson = {
                    type: 'Feature',
                    geometry: data.data[0].geometry,
                    properties: {
                        name: data.data[0].forest_circle
                    }
                };
                
                currentLayers.circle = L.geoJSON(geoJson, {
                    style: {
                        color: '#0000FF',
                        weight: 2,
                        opacity: 1,
                        fillOpacity: 0.2
                    }
                }).addTo(map);
                
                // Zoom to bounds with some padding and higher zoom level
                const bounds = currentLayers.circle.getBounds();
                map.fitBounds(bounds, {
                    padding: [50, 50],
                    maxZoom: 14
                });
            } else {
                console.error('Error loading circle boundary:', data.message);
            }
            hideLoader();
        })
        .catch(error => {
            console.error('Error:', error);
            hideLoader();
        });
}

//Geting change analysis data 

async function getChangeAnalysisData(divName) {
  try {
    showLoader();

    const response = await fetch('statsAPIs/getLULCSpatial.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ division: divName })
    });

    const data = await response.json();
    hideLoader();  // ✅ Now called before returning
    return data;
    
  } catch (error) {
    console.error('Error:', error);
    hideLoader();  // ✅ Also called on error
    return null;
  }
}



// Draw division boundary on map
function drawDivisionBoundary(division) {
    showLoader();
    clearMapLayers('division');
    
    fetch(`${API_BASE_URL}get_division.php?forest_division=${encodeURIComponent(division)}`)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success' && data.data.length > 0) {
                const geoJson = {
                    type: 'Feature',
                    geometry: data.data[0].geometry,
                    properties: {
                        name: data.data[0].forest_division
                    }
                };
                
                currentLayers.division = L.geoJSON(geoJson, {
                    style: {
                        color: '#800080',
                        weight: 2,
                        opacity: 1,
                        fillOpacity: 0.2
                    }
                }).addTo(map);
                
                // Zoom to bounds with some padding and even higher zoom level
                const bounds = currentLayers.division.getBounds();
                map.fitBounds(bounds, {
                    padding: [50, 50],
                    maxZoom: 30
                });
            } else {
                console.error('Error loading division boundary:', data.message);
            }
            hideLoader();
        })
        .catch(error => {
            console.error('Error:', error);
            hideLoader();
        });
}

// Update the handleForestSelection function
// function handleForestSelection(forestId) {
//     if (!forestId) {
//         // If no forest selected, load all data
//         loadAllLULCStats();
//         return;
//     }
    
    // Store the selected forest ID
//     selectedForestId = forestId;
//     console.log('Selected Forest ID:', selectedForestId);
    
//     showLoader();
//     clearMapLayers('forest');
    
//     fetch(`${API_BASE_URL}get_forest.php?unique_id=${encodeURIComponent(forestId)}`)
//         .then(response => response.json())
//         .then(data => {
//             if (data.status === 'success' && data.data.features.length > 0) {
//                 const feature = data.data.features[0];
                
//                 currentLayers.forest = L.geoJSON(feature, {
//                     style: {
//                         color: '#008000',
//                         weight: 2,
//                         opacity: 1,
//                         fillOpacity: 0.3
//                     },
//                     onEachFeature: function(feature, layer) {
//                         const props = feature.properties;
//                         const popupContent = `
//                             <div style="max-width: 300px;">
//                                 <h6>${props.forest_name}</h6>
//                                 <hr>
//                                 <p><strong>Zone:</strong> ${props.f_zone}</p>
//                                 <p><strong>Circle:</strong> ${props.f_circle}</p>
//                                 <p><strong>Division:</strong> ${props.f_division}</p>
//                                 <p><strong>Area (Acres):</strong> ${props.gross_area_acre}</p>
//                                 <p><strong>Forest Type:</strong> ${props.forest_type}</p>
//                             </div>
//                         `;
//                         layer.bindPopup(popupContent);
//                     }
//                 }).addTo(map);
                
//                 // Zoom to bounds
//                 const bounds = currentLayers.forest.getBounds();
//                 map.fitBounds(bounds, {
//                     padding: [50, 50],
//                     maxZoom: 16
//                 });
                
//                 // Load LULC stats for this forest
//                 loadForestLULCStats(forestId);
//             } else {
//                 console.error('Error loading forest boundary:', data.message);
//                 loadForestLULCStats(forestId); // Still try to load stats even if boundary fails
//             }
//             hideLoader();
//         })
//         .catch(error => {
//             console.error('Error:', error);
//             hideLoader();
//         });
// }


// Clear specific layer from map
function clearMapLayers(layerType) {
    if (layerType && currentLayers[layerType]) {
        map.removeLayer(currentLayers[layerType]);
        currentLayers[layerType] = null;
    } else if (!layerType) {
        // Clear all layers if no specific type provided
        Object.keys(currentLayers).forEach(key => {
            if (currentLayers[key]) {
                map.removeLayer(currentLayers[key]);
                currentLayers[key] = null;
            }
        });
    }
}

// Update setupEventListeners to include forest selection
function setupEventListeners() {
    // Zone selection
    document.getElementById('zoneSel').addEventListener('change', function() {
        const zone = this.value;
        handleZoneSelection(zone);
    });

    // Circle selection
    document.getElementById('circleSel').addEventListener('change', function() {
        const circle = this.value;
        handleCircleSelection(circle);
    });

    // Division selection
    document.getElementById('divisionSel').addEventListener('change', function() {
        const division = this.value;
        handleDivisionSelection(division);
    });

    // Forest selection
    // document.getElementById('forestSel').addEventListener('change', function() {
    //     const forestId = this.value;
    //     handleForestSelection(forestId);
    // });
}

function initializeLULCChart() {
    const ctx = document.getElementById('lulcChart').getContext('2d');
    lulcChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [], // Will contain years
            datasets: [ // Will contain land cover types
                {
                    label: 'Tree Cover',
                    backgroundColor: 'rgba(0, 150, 0, 0.8)',
                    borderColor: 'rgba(0, 150, 0, 1)',
                    borderWidth: 1,
                    hidden: false
                },
                {
                    label: 'Agricultural/Grass Land',
                    backgroundColor: 'rgba(255, 255, 0, 0.94)',
                    borderColor: 'rgba(255, 255, 0, 1)',
                    borderWidth: 1,
                    hidden: false
                },
                {
                    label: 'Water',
                    backgroundColor: 'rgba(0, 0, 255, 0.8)',
                    borderColor: 'rgba(0, 0, 255, 1)',
                    borderWidth: 1,
                    hidden: false
                },
                {
                    label: 'Barren Land',
                    backgroundColor: 'rgba(160, 82, 45, 0.8)',
                    borderColor: 'rgba(160, 82, 45, 1)',
                    borderWidth: 1,
                    hidden: false
                },
                {
                    label: 'Built-up Area',
                    backgroundColor: 'rgba(255, 0, 0, 0.8)',
                    borderColor: 'rgba(255, 0, 0, 1)',
                    borderWidth: 1,
                    hidden: false
                }
            ]
        },
        options: {
            indexAxis: 'y', // Makes bars horizontal (years on y-axis)
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Forest Cover Change Analysis',
                    font: {
                        size: 14,
                        weight: 'bold'
                    }
                },
                legend: {
                    position: 'right',
                    onClick: function(e, legendItem, legend) {
                        // Keep default toggle behavior
                        const index = legendItem.datasetIndex;
                        const meta = this.chart.getDatasetMeta(index);
                        meta.hidden = meta.hidden === null ? !this.chart.data.datasets[index].hidden : null;
                        this.chart.update();
                    }
                }
            },
            scales: {
                y: {
                    title: {
                        display: true,
                        text: 'Year',
                        font: {
                            weight: 'bold'
                        }
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'SQ. KM',
                        font: {
                            weight: 'bold'
                        }
                    },
                    beginAtZero: true
                }
            }
        }
    });
}

//Function to load stats

async function loadNumberStat (divName) {
    try {
    showLoader();

    const response = await fetch('statsAPIs/getLCLUStat.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ division: divName })
    });

    const data = await response.json();
    hideLoader();  // ✅ Now called before returning
    return data;
    
  } catch (error) {
    console.error('Error:', error);
    hideLoader();  // ✅ Also called on error
    return null;
  }
}


//Function to update chart 

function updateChart(lulcData) {
  const years = Object.keys(lulcData);

  const labelToKey = {
    'Tree Cover': 'tree_cover',
    'Agricultural/Grass Land': 'agriland_grass',
    'Water': 'water',
    'Barren Land': 'barren_land',
    'Built-up Area': 'builtup'
  };

  lulcChart.data.labels = years;

  lulcChart.data.datasets.forEach(dataset => {
    const apiKey = labelToKey[dataset.label];
    dataset.data = years.map(year => lulcData[year][apiKey] || 0);
  });

  lulcChart.update();
}


// Update the loadAllLULCStats function
// function loadAllLULCStats(years = null) {
//     showLoader();
    
//     let url = STATS_API_BASE_URL;
//     if (years && years.length > 0) {
//         url += `?years=${years.join(',')}`;
//     }
    
//     fetch(url)
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error(`HTTP error! status: ${response.status}`);
//             }
//             return response.json();
//         })
//         .then(data => {
//             if (data.status === 'success') {
//                 if (data.data.message) {
//                     // Show no data message
//                     document.getElementById('yearCheckboxesContainer').innerHTML = 
//                         '<p class="text-muted no-data-message">No data available</p>';
//                     resetLULCChart();
//                 } else {
//                     updateLULCChartData(data.data);
//                     availableYears = data.data.available_years || [];
//                     updateYearCheckboxes();
//                 }
//             } else {
//                 console.error('Error loading LULC stats:', data.message);
//                 document.getElementById('yearCheckboxesContainer').innerHTML = 
//                     '<p class="text-muted no-data-message">Error loading data</p>';
//             }
//         })
//         .catch(error => {
//             console.error('Error:', error);
//             document.getElementById('yearCheckboxesContainer').innerHTML = 
//                 '<p class="text-muted no-data-message">Failed to load data</p>';
//         })
//         .finally(() => {
//             hideLoader();
//         });
// }

// Update the loadForestLULCStats function
// function loadForestLULCStats(forestId, years = null) {
//     showLoader();
    
//     let url = `${STATS_API_BASE_URL}?unique_id=${encodeURIComponent(forestId)}`;
//     if (years && years.length > 0) {
//         url += `&years=${years.join(',')}`;
//     }
    
//     fetch(url)
//         .then(response => response.json())
//         .then(data => {
//             if (data.status === 'success') {
//                 updateLULCChartData(data.data);
//                 availableYears = data.data.available_years || [];
//                 //updateYearCheckboxes();
//             } else {
//                 console.error('Error loading LULC stats:', data.message);
//             }
//             hideLoader();
//         })
//         .catch(error => {
//             console.error('Error:', error);
//             hideLoader();
//         });
// }

// // Update the loadLULCStats function to handle dynamic years
// function loadLULCStats(forestId, years = null) {
//     showLoader();
    
//     // Build the API URL with parameters
//     let url = `${STATS_API_BASE_URL}get_lulc_stats.php?unique_id=${encodeURIComponent(forestId)}`;
    
//     // Add years parameter if provided
//     if (years && years.length > 0) {
//         url += `&years=${years.join(',')}`;
//     }
    
//     fetch(url)
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error(`HTTP error! status: ${response.status}`);
//             }
//             return response.json();
//         })
//         .then(data => {
//             if (data.status === 'success') {
//                 // Handle case when no data is available
//                 if (data.data.message) {
//                     console.log(data.data.message);
                    
//                     // Clear the chart
//                     lulcChart.data.labels = [];
//                     lulcChart.data.datasets.forEach(dataset => {
//                         dataset.data = [];
//                     });
//                     lulcChart.update();
                    
//                     // Clear available years
//                     availableYears = [];
//                     updateYearCheckboxes();
                    
//                     // Show message to user
//                     alert('No LULC data available for this forest');
//                     return;
//                 }
                
//                 // Update the chart with new data
//                 lulcChart.data.labels = data.data.years;
//                 lulcChart.data.datasets[0].data = data.data.tree_cover;
//                 lulcChart.data.datasets[1].data = data.data.agriland_grass;
//                 lulcChart.data.datasets[2].data = data.data.water;
//                 lulcChart.data.datasets[3].data = data.data.barren_land;
//                 lulcChart.data.datasets[4].data = data.data.builtup;
//                 lulcChart.update();
                
//                 // Update available years (if not filtered by specific years)
//                 if (!years) {
//                     availableYears = data.data.available_years || [];
//                     updateYearCheckboxes();
//                 }
//             } else {
//                 console.error('Error loading LULC stats:', data.message);
//                 alert('Error loading LULC data: ' + data.message);
//             }
//         })
//         .catch(error => {
//             console.error('Error:', error);
//             alert('Failed to load LULC data. Please try again.');
//         })
//         .finally(() => {
//             hideLoader();
//         });
// }

// function updateLULCChartData(chartData) {
//     if (!lulcChart || !chartData.years || chartData.years.length === 0) {
//         return;
//     }

//     // Filter years based on selection
//     const yearsToShow = selectedYears.length > 0 
//         ? chartData.years.filter(year => selectedYears.includes(year.toString()))
//         : chartData.years;

//     // Update chart labels (years)
//     lulcChart.data.labels = yearsToShow;

//     // Update each dataset's data
//     lulcChart.data.datasets[0].data = getDataForType('tree_cover', chartData, yearsToShow);
//     lulcChart.data.datasets[1].data = getDataForType('agriland_grass', chartData, yearsToShow);
//     lulcChart.data.datasets[2].data = getDataForType('water', chartData, yearsToShow);
//     lulcChart.data.datasets[3].data = getDataForType('barren_land', chartData, yearsToShow);
//     lulcChart.data.datasets[4].data = getDataForType('builtup', chartData, yearsToShow);

//     lulcChart.update();
// }

function getDataForType(type, chartData, yearsToShow) {
    return yearsToShow.map(year => {
        const yearIndex = chartData.years.indexOf(year);
        return chartData[type][yearIndex];
    });
}

// Helper function to get consistent colors for years
function getColorForYear(year, index, isBorder = false) {
    const colors = [
        'rgba(54, 162, 235, 0.8)',  // Blue
        'rgba(255, 99, 132, 0.8)',   // Red
        'rgba(75, 192, 192, 0.8)',   // Teal
        'rgba(153, 102, 255, 0.8)',  // Purple
        'rgba(255, 159, 64, 0.8)',   // Orange
        'rgba(199, 199, 199, 0.8)'   // Gray
    ];
    
    const borderColors = [
        'rgba(54, 162, 235, 1)',
        'rgba(255, 99, 132, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(199, 199, 199, 1)'
    ];
    
    // Use year-based index to get consistent colors
    const colorIndex = year % colors.length;
    return isBorder ? borderColors[colorIndex] : colors[colorIndex];
}

// Function to reset the LULC chart
function resetLULCChart() {
    if (lulcChart) {
        lulcChart.data.labels = [];
        lulcChart.data.datasets.forEach(dataset => {
            dataset.data = [];
        });
        lulcChart.update();
    }
    availableYears = [];
    updateYearCheckboxes();
}


// function initializeYearCheckboxes() {
//     const container = document.getElementById('yearCheckboxesContainer');
//     container.innerHTML = '<p class="text-muted">Please select a forest to see available years</p>';
//     selectedYears = [];
// }
// Update year checkboxes based on available years
// function updateYearCheckboxes() {
//     const container = document.getElementById('yearCheckboxesContainer');
    
//     if (!availableYears || availableYears.length === 0) {
//         container.innerHTML = '<p class="text-muted no-data-message">No data available for selected forest</p>';
//         return;
//     }
    
//     container.innerHTML = ''; // Clear previous content
    
//     // Sort years in descending order (newest first)
//     const sortedYears = [...availableYears].sort((a, b) => b - a);
    
//     sortedYears.forEach(year => {
//         const checkboxId = `year${year}`;
//         const checkboxDiv = document.createElement('div');
//         checkboxDiv.className = 'year-checkbox';
        
//         const checkbox = document.createElement('input');
//         checkbox.type = 'checkbox';
//         checkbox.id = checkboxId;
//         checkbox.value = year;
//         checkbox.addEventListener('change', handleYearSelection);
        
//         // Check if this year is already selected
//         if (selectedYears.includes(year.toString())) {
//             checkbox.checked = true;
//         }
        
//         const label = document.createElement('label');
//         label.htmlFor = checkboxId;
//         label.textContent = year;
        
//         checkboxDiv.appendChild(checkbox);
//         checkboxDiv.appendChild(label);
//         container.appendChild(checkboxDiv);
//     });
// }

// function handleYearSelection() {
//     const checkboxes = document.querySelectorAll('.year-checkbox input[type="checkbox"]');
//     selectedYears = [];
    
//     checkboxes.forEach(checkbox => {
//         if (checkbox.checked) {
//             selectedYears.push(checkbox.value);
//         }
//     });

//     // Reload data with selected years
//     if (selectedForestId) {
//         loadForestLULCStats(selectedForestId, selectedYears);
//     } else {
//         loadAllLULCStats(selectedYears);
//     }
// }

// Filter existing chart data by selected years
// function filterChartDataByYears() {
//     if (!lulcChart || availableYears.length === 0) return;
    
//     const yearsToShow = selectedYears.length > 0 ? selectedYears : availableYears;
    
//     // Get indices of years to show
//     const indices = [];
//     yearsToShow.forEach(year => {
//         const idx = lulcChart.data.labels.indexOf(year);
//         if (idx !== -1) indices.push(idx);
//     });
    
//     // Filter the data
//     const filteredData = {
//         labels: [],
//         tree_cover: [],
//         agriland_grass: [],
//         water: [],
//         barren_land: [],
//         builtup: []
//     };
    
//     indices.forEach(idx => {
//         filteredData.labels.push(lulcChart.data.labels[idx]);
//         filteredData.tree_cover.push(lulcChart.data.datasets[0].data[idx]);
//         filteredData.agriland_grass.push(lulcChart.data.datasets[1].data[idx]);
//         filteredData.water.push(lulcChart.data.datasets[2].data[idx]);
//         filteredData.barren_land.push(lulcChart.data.datasets[3].data[idx]);
//         filteredData.builtup.push(lulcChart.data.datasets[4].data[idx]);
//     });
    
//     updateLULCChartData(filteredData);
// }


// function updateLULCChart() {
//     selectedYears = [];
//     const checkboxes = document.querySelectorAll('.year-checkbox input[type="checkbox"]:checked');
    
//     checkboxes.forEach(checkbox => {
//         selectedYears.push(checkbox.value);
//     });
    
//     // If no years selected, show all available years
//     const yearsToShow = selectedYears.length > 0 ? selectedYears.sort() : availableYears;
    
//     // Filter the chart data to only show selected years
//     if (lulcChart) {
//         // We need to reload the data to filter by years
//         loadLULCStats(selectedForestId, yearsToShow);
//     }
// }

// Toggle year selection section
function toggleYearSelection() {
    const yearSelection = document.getElementById('yearSelection');
    const toggleIcon = document.getElementById('toggleIcon');
    
    yearSelection.classList.toggle('show');
    toggleIcon.classList.toggle('rotated');
}

// Utility functions
function resetDropdown(dropdown, placeholder) {
    dropdown.innerHTML = `<option value="" selected>${placeholder}</option>`;
}

function showLoader() {
    document.getElementById('loader').classList.add('show');
}

function hideLoader() {
    document.getElementById('loader').classList.remove('show');
}

// Update chart based on selected years
// function updateChart() {
//     const selectedYears = [];
//     const yearCheckboxes = document.querySelectorAll('input[type="checkbox"]:checked');
    
//     yearCheckboxes.forEach(checkbox => {
//         selectedYears.push(checkbox.value);
//     });

//     if (selectedYears.length > 0) {
//         const labels = selectedYears.sort();
        
//         // Mock data for each category
//         const mockData = {
//             '2019': { gross: 272, planted: 0, total_blank: 272, plantable: 200, unplantable: 72, encroached: 0 },
//             '2020': { gross: 272, planted: 175, total_blank: 97, plantable: 80, unplantable: 17, encroached: 5 },
//             '2021': { gross: 272, planted: 260, total_blank: 12, plantable: 10, unplantable: 2, encroached: 8 },
//             '2022': { gross: 272, planted: 260, total_blank: 12, plantable: 10, unplantable: 2, encroached: 10 },
//             '2023': { gross: 272, planted: 250, total_blank: 22, plantable: 20, unplantable: 2, encroached: 12 },
//             '2024': { gross: 272, planted: 250, total_blank: 22, plantable: 20, unplantable: 2, encroached: 15 }
//         };

//         comparisonChart.data.labels = labels;
//         comparisonChart.data.datasets[0].data = labels.map(year => mockData[year].gross);
//         comparisonChart.data.datasets[1].data = labels.map(year => mockData[year].planted);
//         comparisonChart.data.datasets[2].data = labels.map(year => mockData[year].total_blank);
//         comparisonChart.data.datasets[3].data = labels.map(year => mockData[year].plantable);
//         comparisonChart.data.datasets[4].data = labels.map(year => mockData[year].unplantable);
//         comparisonChart.data.datasets[5].data = labels.map(year => mockData[year].encroached);
        
//         comparisonChart.update();
//     } else {
//         // Reset to default view
//         comparisonChart.data.labels = ['2019', '2020', '2021', '2022', '2023', '2024'];
//         comparisonChart.data.datasets[0].data = [272, 272, 272, 272, 272, 272];
//         comparisonChart.data.datasets[1].data = [0, 175, 260, 260, 250, 250];
//         comparisonChart.data.datasets[2].data = [272, 97, 12, 12, 22, 22];
//         comparisonChart.data.datasets[3].data = [200, 80, 10, 10, 20, 20];
//         comparisonChart.data.datasets[4].data = [72, 17, 2, 2, 2, 2];
//         comparisonChart.data.datasets[5].data = [0, 5, 8, 10, 12, 15];
//         comparisonChart.update();
//     }
// }

// Reset selection function
// Update the resetSelection function
function resetSelection() {
    // Reset all dropdowns
    document.getElementById('zoneSel').value = '';
    resetDropdown(document.getElementById('circleSel'), 'Select Circle');
    resetDropdown(document.getElementById('divisionSel'), 'Select Division');
    //resetDropdown(document.getElementById('forestSel'), 'Select Forest');
    
    // Disable dependent dropdowns
    document.getElementById('circleSel').disabled = true;
    document.getElementById('divisionSel').disabled = true;
    //document.getElementById('forestSel').disabled = true;
    
    // Clear map
    clearMapLayers();
    map.setView([31.5204, 74.3587], 8);
    
    // Reset chart to show all data
    loadAllLULCStats();
    
    // Close year selection if open
    document.getElementById('yearSelection').classList.remove('show');
    document.getElementById('toggleIcon').classList.remove('rotated');
}

// Reset year selection
function resetYearSelection() {
    // Uncheck all checkboxes
    document.querySelectorAll('.year-checkbox input[type="checkbox"]').forEach(checkbox => {
        checkbox.checked = false;
    });
    
    // Select all available years
    selectedYears = [...availableYears];
    
    // Reload data
    if (selectedForestId) {
        loadForestLULCStats(selectedForestId);
    } else {
        loadAllLULCStats();
    }
}

// Fix the click handler at the bottom of your script
document.addEventListener('click', function(e) {
    if (e.target.closest('.year-checkbox')) {
        const checkbox = e.target.closest('.year-checkbox').querySelector('input[type="checkbox"]');
        if (e.target !== checkbox) {
            checkbox.checked = !checkbox.checked;
            const event = new Event('change');
            checkbox.dispatchEvent(event);
        }
    }
});
    </script>
</body>

</html>