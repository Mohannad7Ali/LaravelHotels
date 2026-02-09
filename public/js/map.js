document.addEventListener("DOMContentLoaded", async () => {
    const map = L.map("map").setView([29.0, 45.0], 5);

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution: "&copy; OpenStreetMap",
    }).addTo(map);

    try {
        const response = await fetch("/hotels/map-data");
        const hotels = await response.json();

        hotels.forEach((hotel) => {
            const marker = L.marker([hotel.latitude, hotel.longitude]).addTo(
                map,
            );

            marker.bindPopup(`
                <strong>${hotel.name}</strong><br/>
                City: ${hotel.city}<br/>
                Stars: ${hotel.stars} ⭐<br/>
                Price: $${hotel.price_per_night}
            `);
        });
    } catch (error) {
        console.error("Map load error:", error);
        alert("Failed to load hotels data");
    }
});
