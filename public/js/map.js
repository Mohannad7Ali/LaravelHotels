document.addEventListener("DOMContentLoaded", () => {
    // إنشاء الخريطة
    const map = L.map("map").setView([46.8182, 8.2275], 7);
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution: "&copy; OpenStreetMap contributors",
    }).addTo(map);

    let hotelMarkers = [];
    let hotelsData = [];

    // إزالة الماركرات القديمة
    function clearMarkers() {
        hotelMarkers.forEach((m) => map.removeLayer(m));
        hotelMarkers = [];
    }

    // تحديث الخريطة بعد الفلاتر
    function updateMap() {
        const city = document.getElementById("filterCity").value;
        const stars = document.getElementById("filterStars").value;
        const name = document.getElementById("searchName").value.toLowerCase();

        let filtered = hotelsData;

        if (city) filtered = filtered.filter((h) => h.city === city);
        if (stars) filtered = filtered.filter((h) => h.stars == stars);
        if (name)
            filtered = filtered.filter((h) =>
                h.name.toLowerCase().includes(name),
            );

        clearMarkers();

        filtered.forEach((h) => {
            const marker = L.marker([h.latitude, h.longitude])
                .addTo(map)
                .bindPopup(
                    `<strong>${h.name}</strong><br>${h.city}<br>${h.stars ? h.stars + " ⭐" : ""}`,
                );
            hotelMarkers.push(marker);
        });
    }

    // تهيئة مستمعي الفلاتر
    function initFilters() {
        ["filterCity", "filterStars", "searchName"].forEach((id) => {
            document.getElementById(id).addEventListener("input", updateMap);
            document.getElementById(id).addEventListener("change", updateMap);
        });
    }

    // طلب إذن الموقع أولًا
    if (!navigator.geolocation) {
        document.getElementById("status").textContent =
            "Geolocation not supported.";
        return;
    }

    navigator.geolocation.getCurrentPosition(
        async (position) => {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;

            // ماركر المستخدم
            L.marker([lat, lng], {
                icon: L.icon({
                    iconUrl:
                        "https://cdn-icons-png.flaticon.com/512/64/64113.png",
                    iconSize: [32, 32],
                    iconAnchor: [16, 32],
                    popupAnchor: [0, -32],
                }),
            })
                .addTo(map)
                .bindPopup("You are here")
                .openPopup();

            map.setView([lat, lng], 12);

            // جلب الفنادق من Controller
            try {
                const params = new URLSearchParams({ lat, lng });
                const res = await fetch(`/hotels/nearby?${params}`);
                hotelsData = await res.json();

                if (!hotelsData.length) {
                    document.getElementById("status").textContent =
                        "No nearby hotels found.";
                }

                // عرض الفنادق
                updateMap();
                initFilters();
            } catch (err) {
                console.error("Error fetching hotels:", err);
                document.getElementById("status").textContent =
                    "Failed to load hotels.";
            }
        },
        (error) => {
            console.error(error);
            document.getElementById("status").textContent =
                "Location permission denied. Cannot show nearby hotels.";
        },
    );
});
