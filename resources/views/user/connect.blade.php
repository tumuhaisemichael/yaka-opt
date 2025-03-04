<x-app-layout>
    <!-- Shared Styles -->
    <style>
        .radar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(33, 150, 243, 0.1) 0%, rgba(33, 150, 243, 0.2) 30%, rgba(33, 150, 243, 0.3) 60%, rgba(33, 150, 243, 0.4) 100%);
            position: relative;
            overflow: hidden;
        }
        .radar::before {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            background: conic-gradient(rgba(33, 150, 243, 0.5), transparent 70%);
            border-radius: 50%;
            animation: radar-scan 5s linear infinite;
        }
        @keyframes radar-scan {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        #deviceOverlay {
            transition: opacity 0.3s ease;
        }
        @media (max-width: 767px) {
            .radar { width: 100px; height: 100px; }
        }
    </style>

    <!-- Desktop Layout -->
    <div class="hidden md:flex" style="height: 100vh;">
        <nav class="bg-[#2e7d32] dark:bg-[#1b5e20]" style="width: 250px; padding: 20px;">
            <h3 class="text-white text-lg font-semibold mb-4 text-center">Cost</h3>
            <ul class="list-unstyled">
                <li><a href="{{ route('dashboard') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2"><i class="fas fa-tachometer-alt me-2"></i>{{ __('Dashboard') }}</a></li>
                <li><a href="{{ route('user.update') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2"><i class="fas fa-user-edit me-2"></i>{{ __('Yaka-Opt') }}</a></li>
                <li><a href="{{ route('user.cost') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2"><i class="fas fa-home me-2"></i>{{ __('Cost') }}</a></li>
                <li><a href="{{ route('user.appliances') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2"><i class="fas fa-plug me-2"></i>{{ __('Appliance') }}</a></li>
                <li><a href="{{ route('user.connect') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2"><i class="fas fa-link me-2"></i>{{ __('Connected Devices') }}</a></li>
                <li><a href="{{ route('user.yaka') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2"><i class="fas fa-user-edit me-2"></i>{{ __('Yaka') }}</a></li>
            </ul>
        </nav>

        <div class="flex-grow p-4 bg-[#f1f8e9] dark:bg-[#dcedc8]" style="overflow-y: auto;">
            <div class="container bg-white rounded shadow-lg p-4">
                <div class="text-center">
                    <h1 class="text-2xl font-bold text-[#2e7d32]">Device Connectivity Dashboard</h1>
                    <p id="currentDateTimeDesktop" class="text-[#757575]"></p>
                </div>

                <div class="mt-6">
                    <h2 class="text-xl font-bold mb-4">Discover Devices</h2>
                    <div class="flex gap-4">
                        <button onclick="startDiscovery('wifi', 'Desktop')" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Scan Wi-Fi Devices</button>
                        <button onclick="startDiscovery('bluetooth', 'Desktop')" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Scan Bluetooth Devices</button>
                    </div>
                </div>

                <div id="radarAnimationDesktop" class="hidden mt-6 flex justify-center">
                    <div class="radar"></div>
                </div>

                <div class="mt-6">
                    <h2 class="text-xl font-bold mb-4">Available Devices</h2>
                    <div id="deviceListDesktop" class="space-y-2"></div>
                </div>

                <div class="mt-6">
                    <h2 class="text-xl font-bold mb-4">Connection Status</h2>
                    <div id="connectionStatusDesktop" class="p-4 bg-gray-100 rounded">
                        <p class="text-gray-700">No devices connected.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Layout -->
    <div class="md:hidden">
        <div class="bg-[#2e7d32] p-4 flex justify-between items-center">
            <h3 class="text-white font-bold">Cost</h3>
            <button id="menuToggleMobile" class="text-white"><i class="fas fa-bars"></i> Menu</button>
        </div>

        <div id="mobileMenuMobile" class="hidden bg-[#2e7d32] p-4">
            <ul class="list-unstyled">
                <li><a href="{{ route('dashboard') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2"><i class="fas fa-tachometer-alt me-2"></i>{{ __('Dashboard') }}</a></li>
                <li><a href="{{ route('user.update') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2"><i class="fas fa-user-edit me-2"></i>{{ __('Yaka-Opt') }}</a></li>
                <li><a href="{{ route('user.cost') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2"><i class="fas fa-home me-2"></i>{{ __('Cost') }}</a></li>
                <li><a href="{{ route('user.appliances') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2"><i class="fas fa-plug me-2"></i>{{ __('Appliance') }}</a></li>
                <li><a href="{{ route('user.connect') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2"><i class="fas fa-link me-2"></i>{{ __('Connected Devices') }}</a></li>
                <li><a href="{{ route('user.yaka') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2"><i class="fas fa-user-edit me-2"></i>{{ __('Yaka') }}</a></li>
            </ul>
        </div>

        <div class="p-4 bg-[#f1f8e9] dark:bg-[#dcedc8]" style="overflow-y: auto;">
            <div class="container bg-white rounded shadow-lg p-4">
                <div class="text-center">
                    <h1 class="text-2xl font-bold text-[#2e7d32]">Device Connectivity Dashboard</h1>
                    <p id="currentDateTimeMobile" class="text-[#757575]"></p>
                </div>

                <div class="mt-6">
                    <h2 class="text-xl font-bold mb-4">Discover Devices</h2>
                    <div class="flex gap-4">
                        <button onclick="startDiscovery('wifi', 'Mobile')" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Scan Wi-Fi Devices</button>
                        <button onclick="startDiscovery('bluetooth', 'Mobile')" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Scan Bluetooth Devices</button>
                    </div>
                </div>

                <div id="radarAnimationMobile" class="hidden mt-6 flex justify-center">
                    <div class="radar"></div>
                </div>

                <div class="mt-6">
                    <h2 class="text-xl font-bold mb-4">Available Devices</h2>
                    <div id="deviceListMobile" class="space-y-2"></div>
                </div>

                <div class="mt-6">
                    <h2 class="text-xl font-bold mb-4">Connection Status</h2>
                    <div id="connectionStatusMobile" class="p-4 bg-gray-100 rounded">
                        <p class="text-gray-700">No devices connected.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Device Connection Overlay (Shared) -->
    <div id="deviceOverlay" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
        <div class="bg-white rounded-lg shadow-lg p-6 w-80">
            <h3 class="text-lg font-semibold mb-4" id="overlayDeviceName">Device Name</h3>
            <div class="space-y-4">
                <button onclick="connectDevice()" class="w-full px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Connect</button>
                <button onclick="closeOverlay()" class="w-full px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Cancel</button>
            </div>
        </div>
    </div>

    <!-- Shared JavaScript -->
    <script>
        // Mock data for devices
        const mockDevices = {
            wifi: [
                { name: "Smart Light Bulb", type: "Wi-Fi", id: "wifi-001" },
                { name: "Smart Thermostat", type: "Wi-Fi", id: "wifi-002" },
                { name: "Security Camera", type: "Wi-Fi", id: "wifi-003" },
            ],
            bluetooth: [
                { name: "Bluetooth Speaker", type: "Bluetooth", id: "bt-001" },
                { name: "Fitness Tracker", type: "Bluetooth", id: "bt-002" },
                { name: "Wireless Headphones", type: "Bluetooth", id: "bt-003" },
            ],
        };

        // Shared State
        let state = {
            discoveredDevices: JSON.parse(localStorage.getItem("discoveredDevices")) || [],
            connectedDevices: JSON.parse(localStorage.getItem("connectedDevices")) || [],
            selectedDevice: null,
            isScanning: JSON.parse(localStorage.getItem("isScanning")) || false,
            scanType: localStorage.getItem("scanType") || null
        };

        // Update State and LocalStorage
        function updateState(key, value) {
            state[key] = value;
            localStorage.setItem(key, JSON.stringify(value));
            syncLayouts();
        }

        // Initialize UI
        function initializeUI(layout) {
            const suffix = layout === "Desktop" ? "Desktop" : "Mobile";
            updateDateTime(suffix);
            displayDevices(suffix);
            updateConnectionStatus(suffix);
            if (state.isScanning) {
                resumeDiscovery(state.scanType, suffix);
            }
        }

        // Sync Layouts on Resize
        function syncLayouts() {
            const isDesktop = window.innerWidth >= 768;
            initializeUI(isDesktop ? "Desktop" : "Mobile");
        }

        // Update Date and Time
        function updateDateTime(suffix) {
            let now = new Date();
            let options = { weekday: "long", year: "numeric", month: "long", day: "numeric" };
            let formattedDate = now.toLocaleDateString("en-US", options);
            let formattedTime = now.toLocaleTimeString("en-US", { hour: "2-digit", minute: "2-digit", second: "2-digit" });
            document.getElementById(`currentDateTime${suffix}`).innerText = `${formattedDate}, ${formattedTime}`;
        }

        // Start Device Discovery
        function startDiscovery(type, layout) {
            const suffix = layout === "Desktop" ? "Desktop" : "Mobile";
            const deviceList = document.getElementById(`deviceList${suffix}`);
            const radarAnimation = document.getElementById(`radarAnimation${suffix}`);

            deviceList.innerHTML = "";
            radarAnimation.classList.remove("hidden");
            updateState("isScanning", true);
            updateState("scanType", type);

            setTimeout(() => {
                radarAnimation.classList.add("hidden");
                const devices = mockDevices[type];
                if (devices && devices.length > 0) {
                    updateState("discoveredDevices", devices);
                    displayDevices(suffix);
                } else {
                    deviceList.innerHTML = `<p class="text-gray-500">No ${type} devices found.</p>`;
                }
                updateState("isScanning", false);
                updateState("scanType", null);
            }, 5000);
        }

        // Resume Discovery (for layout switch during scan)
        function resumeDiscovery(type, suffix) {
            const deviceList = document.getElementById(`deviceList${suffix}`);
            const radarAnimation = document.getElementById(`radarAnimation${suffix}`);

            deviceList.innerHTML = "";
            radarAnimation.classList.remove("hidden");

            setTimeout(() => {
                radarAnimation.classList.add("hidden");
                displayDevices(suffix);
                updateState("isScanning", false);
                updateState("scanType", null);
            }, 5000 - (Date.now() - new Date().setTime(localStorage.getItem("scanStartTime") || Date.now())));
        }

        // Display Discovered Devices
        function displayDevices(suffix) {
            const deviceList = document.getElementById(`deviceList${suffix}`);
            deviceList.innerHTML = "";

            if (state.discoveredDevices.length > 0) {
                state.discoveredDevices.forEach((device) => {
                    const deviceElement = document.createElement("div");
                    deviceElement.className = "p-2 bg-white border rounded flex justify-between items-center cursor-pointer hover:bg-gray-50";
                    deviceElement.innerHTML = `
                        <div>
                            <p class="font-semibold">${device.name}</p>
                            <p class="text-sm text-gray-500">${device.type}</p>
                        </div>
                    `;
                    deviceElement.addEventListener("click", () => openOverlay(device));
                    deviceList.appendChild(deviceElement);
                });
            } else {
                deviceList.innerHTML = `<p class="text-gray-500">No devices found.</p>`;
            }
        }

        // Open Device Connection Overlay
        function openOverlay(device) {
            state.selectedDevice = device;
            const overlay = document.getElementById("deviceOverlay");
            const overlayDeviceName = document.getElementById("overlayDeviceName");

            overlayDeviceName.textContent = device.name;
            overlay.classList.remove("hidden");
        }

        // Close Device Connection Overlay
        function closeOverlay() {
            const overlay = document.getElementById("deviceOverlay");
            overlay.classList.add("hidden");
            state.selectedDevice = null;
        }

        // Connect to a Device
        function connectDevice() {
            if (state.selectedDevice) {
                const connectedDevices = [...state.connectedDevices, state.selectedDevice];
                updateState("connectedDevices", connectedDevices);
                syncLayouts();
                closeOverlay();
            }
        }

        // Update Connection Status
        function updateConnectionStatus(suffix) {
            const connectionStatus = document.getElementById(`connectionStatus${suffix}`);
            if (state.connectedDevices.length > 0) {
                let statusHTML = "<ul class='space-y-2'>";
                state.connectedDevices.forEach((device) => {
                    statusHTML += `
                        <li class="flex justify-between items-center">
                            <div>
                                <p class="font-semibold">${device.name}</p>
                                <p class="text-sm text-gray-500">${device.type}</p>
                            </div>
                            <button onclick="disconnectDevice('${device.id}')" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Disconnect</button>
                        </li>
                    `;
                });
                statusHTML += "</ul>";
                connectionStatus.innerHTML = statusHTML;
            } else {
                connectionStatus.innerHTML = `<p class="text-gray-700">No devices connected.</p>`;
            }
        }

        // Disconnect a Device
        function disconnectDevice(deviceId) {
            const connectedDevices = state.connectedDevices.filter((device) => device.id !== deviceId);
            updateState("connectedDevices", connectedDevices);
            syncLayouts();
        }

        // Mobile Menu Toggle
        document.getElementById("menuToggleMobile").addEventListener("click", () => {
            const mobileMenu = document.getElementById("mobileMenuMobile");
            mobileMenu.classList.toggle("hidden");
        });

        // Real-Time Date/Time Updates
        setInterval(() => {
            updateDateTime("Desktop");
            updateDateTime("Mobile");
        }, 1000);

        // Sync on Resize
        window.addEventListener("resize", () => {
            syncLayouts();
        });

        // Initialize Both Layouts
        document.addEventListener("DOMContentLoaded", () => {
            initializeUI("Desktop");
            initializeUI("Mobile");
            syncLayouts();
        });
    </script>
</x-app-layout>
