document.addEventListener("DOMContentLoaded", () => {
    const map = L.map("map").setView([46.8182, 8.2275], 7);
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution: "&copy; OpenStreetMap",
    }).addTo(map);

    let hotelMarkers = [];

    function clearMarkers() {
        hotelMarkers.forEach((m) => map.removeLayer(m));
        hotelMarkers = [];
    }

    async function loadHotels(lat, lng, filters = {}) {
        const params = new URLSearchParams({ lat, lng });
        const res = await fetch(`/hotels/nearby?${params}`);
        let hotels = await res.json();

        if (hotels.length === 0) {
            console.warn("No nearby hotels, loading fallback hotels");
            alert("No nearby hotels found. Showing all hotels instead.");
            const fallbackRes = await fetch(`/hotels/map-data`);
            hotels = await fallbackRes.json();
        }

        // Apply client-side filters
        if (filters.city) {
            hotels = hotels.filter((h) => h.city === filters.city);
        }
        if (filters.stars) {
            hotels = hotels.filter((h) => h.stars == filters.stars);
        }
        if (filters.name) {
            hotels = hotels.filter((h) =>
                h.name.toLowerCase().includes(filters.name.toLowerCase()),
            );
        }

        clearMarkers();

        hotels.forEach((h) => {
            const marker = L.marker([h.latitude, h.longitude])
                .addTo(map)
                .bindPopup(
                    `<strong>${h.name}</strong><br>${h.city}<br>${h.stars} ⭐`,
                );
            hotelMarkers.push(marker);
        });
    }

    function initFilters(lat, lng) {
        const cityEl = document.getElementById("filterCity");
        const starsEl = document.getElementById("filterStars");
        const nameEl = document.getElementById("searchName");

        [cityEl, starsEl].forEach((el) =>
            el.addEventListener("change", () =>
                loadHotels(lat, lng, {
                    city: cityEl.value,
                    stars: starsEl.value,
                    name: nameEl.value,
                }),
            ),
        );

        nameEl.addEventListener("input", () =>
            loadHotels(lat, lng, {
                city: cityEl.value,
                stars: starsEl.value,
                name: nameEl.value,
            }),
        );
    }

    if (!navigator.geolocation) {
        alert("Geolocation not supported");
        return;
    }

    navigator.geolocation.getCurrentPosition(
        async (position) => {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;

            L.marker([lat, lng])
                .addTo(map)
                .bindPopup("You are here")
                .openPopup();

            map.setView([lat, lng], 11);

            initFilters(lat, lng);

            loadHotels(lat, lng);
        },
        (error) => {
            console.error(error);
            alert("Location permission denied. Cannot show nearby hotels.");
        },
    );
});
