document.addEventListener("DOMContentLoaded", () => {
    const map = L.map("map").setView([46.8182, 8.2275], 7);

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution: "&copy; OpenStreetMap",
    }).addTo(map);

    if (!navigator.geolocation) {
        alert("Geolocation not supported");
        return;
    }

    navigator.geolocation.getCurrentPosition(
        async (position) => {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;

            // user marker
            L.marker([lat, lng])
                .addTo(map)
                .bindPopup("You are here")
                .openPopup();

            map.setView([lat, lng], 11);

            // load nearby hotels
            const res = await fetch(`/hotels/nearby?lat=${lat}&lng=${lng}`);

            const hotels = await res.json();

            hotels.forEach((h) => {
                L.marker([h.latitude, h.longitude])
                    .addTo(map)
                    .bindPopup(
                        `<strong>${h.name}</strong><br>${h.city}<br>${h.stars} ⭐`,
                    );
            });
        },

        (error) => {
            console.error(error);

            alert("Location permission denied. Cannot show nearby hotels.");
        },
    );
});
