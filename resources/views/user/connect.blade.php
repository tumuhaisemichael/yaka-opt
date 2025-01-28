<x-app-layout>
    <!-- Desktop Layout -->
    <div class="hidden md:flex" style="height: 100vh;">
        <!-- Sidebar -->
        <nav class="bg-[#2e7d32] dark:bg-[#1b5e20]" style="width: 250px; padding: 20px;">
            <h3 class="text-white text-lg font-semibold mb-4 text-center">Cost</h3>
            <ul class="list-unstyled">
                <li>
                    <a href="{{ route('dashboard') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2">
                        <i class="fas fa-tachometer-alt me-2"></i>
                        {{ __('Dashboard') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.update') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2">
                        <i class="fas fa-user-edit me-2"></i>
                        {{ __('Yaka-Opt') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.cost') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2">
                        <i class="fas fa-home me-2"></i>
                        {{ __('Cost') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.appliances') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2">
                        <i class="fas fa-plug me-2"></i>
                        {{ __('Appliance') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.connect') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2">
                        <i class="fas fa-link me-2"></i>
                        {{ __('Connected Devices') }}
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="flex-grow p-4 bg-[#f1f8e9] dark:bg-[#dcedc8]" style="overflow-y: auto;">
            <div class="container bg-white rounded shadow-lg p-4">
                <!-- Title -->
                <div class="text-center">
                    <h1 class="text-2xl font-bold text-[#2e7d32]">Device Connectivity Dashboard</h1>
                    <p class="text-[#757575]">January, 20th 2025</p>
                </div>

                <!-- Device Discovery Section -->
                <div class="mt-6">
                    <h2 class="text-xl font-bold mb-4">Discover Devices</h2>
                    <div class="flex gap-4">
                        <button onclick="startDiscovery('wifi')" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            Scan Wi-Fi Devices
                        </button>
                        <button onclick="startDiscovery('bluetooth')" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                            Scan Bluetooth Devices
                        </button>
                    </div>
                </div>

                <!-- Radar Animation -->
                <div id="radarAnimation" class="hidden mt-6 flex justify-center">
                    <div class="radar"></div>
                </div>

                <!-- Device List Section -->
                <div class="mt-6">
                    <h2 class="text-xl font-bold mb-4">Available Devices</h2>
                    <div id="deviceList" class="space-y-2">
                        <!-- Devices will be dynamically added here -->
                    </div>
                </div>

                <!-- Connection Status Section -->
                <div class="mt-6">
                    <h2 class="text-xl font-bold mb-4">Connection Status</h2>
                    <div id="connectionStatus" class="p-4 bg-gray-100 rounded">
                        <p class="text-gray-700">No devices connected.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Device Connection Overlay -->
    <div id="deviceOverlay" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
        <div class="bg-white rounded-lg shadow-lg p-6 w-80">
            <h3 class="text-lg font-semibold mb-4" id="overlayDeviceName">Device Name</h3>
            <div class="space-y-4">
                <button onclick="connectDevice()" class="w-full px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Connect
                </button>
                <button onclick="closeOverlay()" class="w-full px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                    Cancel
                </button>
            </div>
        </div>
    </div>

<!-- JavaScript -->
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

        let selectedDevice = null; // Track the selected device

        // Function to start device discovery
        function startDiscovery(type) {
            const deviceList = document.getElementById("deviceList");
            const radarAnimation = document.getElementById("radarAnimation");

            // Clear previous results
            deviceList.innerHTML = "";

            // Show radar animation
            radarAnimation.classList.remove("hidden");

            // Simulate a delay for scanning (e.g., 5 seconds)
            setTimeout(() => {
                // Hide radar animation
                radarAnimation.classList.add("hidden");

                // Display discovered devices
                const devices = mockDevices[type];
                if (devices && devices.length > 0) {
                    devices.forEach((device) => {
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
                    deviceList.innerHTML = `<p class="text-gray-500">No ${type} devices found.</p>`;
                }
            }, 5000); // 5-second delay for simulation
        }

        // Function to open the device connection overlay
        function openOverlay(device) {
            selectedDevice = device;
            const overlay = document.getElementById("deviceOverlay");
            const overlayDeviceName = document.getElementById("overlayDeviceName");

            overlayDeviceName.textContent = device.name;
            overlay.classList.remove("hidden");
        }

        // Function to close the device connection overlay
        function closeOverlay() {
            const overlay = document.getElementById("deviceOverlay");
            overlay.classList.add("hidden");
        }

        // Function to connect to a device
        function connectDevice() {
            // Add the device to the connected devices list
            const connectedDevices = JSON.parse(localStorage.getItem("connected_devices") || "[]");
            connectedDevices.push(selectedDevice);
            localStorage.setItem("connected_devices", JSON.stringify(connectedDevices));

            // Update the connection status
            updateConnectionStatus();
            closeOverlay();
        }

        // Function to update the connection status
        function updateConnectionStatus() {
            const connectionStatus = document.getElementById("connectionStatus");
            const connectedDevices = JSON.parse(localStorage.getItem("connected_devices") || "[]");

            if (connectedDevices.length > 0) {
                let statusHTML = "<ul class='space-y-2'>";
                connectedDevices.forEach((device) => {
                    statusHTML += `
                        <li class="flex justify-between items-center">
                            <div>
                                <p class="font-semibold">${device.name}</p>
                                <p class="text-sm text-gray-500">${device.type}</p>
                            </div>
                            <button onclick="disconnectDevice('${device.id}')" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                Disconnect
                            </button>
                        </li>
                    `;
                });
                statusHTML += "</ul>";
                connectionStatus.innerHTML = statusHTML;
            } else {
                connectionStatus.innerHTML = `<p class="text-gray-700">No devices connected.</p>`;
            }
        }

        // Function to disconnect a device
        function disconnectDevice(deviceId) {
            let connectedDevices = JSON.parse(localStorage.getItem("connected_devices") || "[]");
            connectedDevices = connectedDevices.filter((device) => device.id !== deviceId);
            localStorage.setItem("connected_devices", JSON.stringify(connectedDevices));
            updateConnectionStatus();
        }

        // Initialize connection status on page load
        updateConnectionStatus();
    </script>

    <!-- CSS for Radar Animation -->
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
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        /* Overlay Animation */
        #deviceOverlay {
            transition: opacity 0.3s ease;
        }
    </style>

    <!-- Mobile Layout -->
    <div class="md:hidden">
        <!-- Mobile Header -->
        <div class="bg-[#2e7d32] p-4 flex justify-between items-center">
            <h3 class="text-white font-bold">Cost</h3>
            <button id="menuToggle" class="text-white">
                <i class="fas fa-bars"></i> Menu
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden bg-[#2e7d32] p-4">
            <ul class="list-unstyled">
                <li>
                    <a href="{{ route('dashboard') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2">
                        <i class="fas fa-tachometer-alt me-2"></i>
                        {{ __('Dashboard') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.update') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2">
                        <i class="fas fa-user-edit me-2"></i>
                        {{ __('Yaka-Opt') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.cost') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2">
                        <i class="fas fa-home me-2"></i>
                        {{ __('Cost') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.appliances') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2">
                        <i class="fas fa-plug me-2"></i>
                        {{ __('Appliance') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.connect') }}" class="d-flex align-items-center text-gray-300 hover:text-blue-400 py-2">
                        <i class="fas fa-link me-2"></i>
                        {{ __('Connected Devices') }}
                    </a>
                </li>
            </ul>
        </div>

    <!-- Mobile Content -->
    <div class="p-4 bg-[#f1f8e9] dark:bg-[#dcedc8]" style="overflow-y: auto;">
        <div class="container bg-white rounded shadow-lg p-4">
            <!-- Device Discovery Section -->
            <div class="mt-6">
                <h2 class="text-xl font-bold mb-4">Discover Devices</h2>
                <div class="flex gap-4">
                    <button onclick="startDiscovery('wifi', 'mobile')" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                        Scan Wi-Fi Devices
                    </button>
                    <button onclick="startDiscovery('bluetooth', 'mobile')" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                        Scan Bluetooth Devices
                    </button>
                </div>
            </div>

            <!-- Radar Animation -->
            <div id="radarAnimationMobile" class="hidden mt-6 flex justify-center">
                <div class="radar"></div>
            </div>

            <!-- Device List Section -->
            <div class="mt-6">
                <h2 class="text-xl font-bold mb-4">Available Devices</h2>
                <div id="deviceListMobile" class="space-y-2">
                    <!-- Devices will be dynamically added here -->
                </div>
            </div>

            <!-- Connection Status Section -->
            <div class="mt-6">
                <h2 class="text-xl font-bold mb-4">Connection Status</h2>
                <div id="connectionStatusMobile" class="p-4 bg-gray-100 rounded">
                    <p class="text-gray-700">No devices connected.</p>
                </div>
            </div>
        </div>
    </div>
</div>
        <script>
        // Function to start device discovery
        function startDiscovery(type, layout = "desktop") {
            const deviceList = document.getElementById(
                layout === "desktop" ? "deviceList" : "deviceListMobile"
            );
            const radarAnimation = document.getElementById(
                layout === "desktop" ? "radarAnimation" : "radarAnimationMobile"
            );

            // Clear previous results
            deviceList.innerHTML = "";

            // Show radar animation
            radarAnimation.classList.remove("hidden");

            // Simulate a delay for scanning
            setTimeout(() => {
                // Hide radar animation
                radarAnimation.classList.add("hidden");

                // Display discovered devices
                const devices = mockDevices[type];
                if (devices && devices.length > 0) {
                    devices.forEach((device) => {
                        const deviceElement = document.createElement("div");
                        deviceElement.className =
                            "p-2 bg-white border rounded flex justify-between items-center cursor-pointer hover:bg-gray-50";
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
                    deviceList.innerHTML = `<p class="text-gray-500">No ${type} devices found.</p>`;
                }
            }, 5000); // 5-second delay for simulation
        }

        // Function to update the connection status
        // Function to update the connection status for mobile layout only
        function updateConnectionStatusMobile() {
            // Get connected devices from localStorage
            const connectedDevices = JSON.parse(localStorage.getItem("connected_devices") || "[]");

            // Target the mobile connection status container
            const mobileStatus = document.getElementById("connectionStatusMobile");

            // Generate the connection status content
            if (connectedDevices.length > 0) {
                let statusHTML = "<ul class='space-y-2'>";
                connectedDevices.forEach((device) => {
                    statusHTML += `
                        <li class="flex justify-between items-center">
                            <div>
                                <p class="font-semibold">${device.name}</p>
                                <p class="text-sm text-gray-500">${device.type}</p>
                            </div>
                            <button onclick="disconnectDevice('${device.id}')" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                Disconnect
                            </button>
                        </li>
                    `;
                });
                statusHTML += "</ul>";
                mobileStatus.innerHTML = statusHTML;
            } else {
                // If no devices are connected
                mobileStatus.innerHTML = `<p class="text-gray-700">No devices connected.</p>`;
            }
        }



            </script>
    </div>

    <!-- JavaScript -->
    <script>
        document.getElementById("menuToggle").addEventListener("click", () => {
            const mobileMenu = document.getElementById("mobileMenu");
            mobileMenu.classList.toggle("hidden");
        });
    </script>
</x-app-layout>
