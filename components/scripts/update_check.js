function checkForUpdates() {
    const versionEl = document.getElementById('app-version');
    const current_version = versionEl.getAttribute('data-version');
    const projektname = versionEl.getAttribute('data-projektname');

    if (!current_version || !projektname) {
        console.error("Fehler: Projektname oder Version fehlen.");
        return;
    }

    const url = `http://192.168.11.187/updateserver/components/api/api_updates.php?projekt=${projektname}&current_version=${current_version}`;

    fetch(url)
        .then(response => {
            if (!response.ok) throw new Error('Netzwerkfehler');
            return response.json();
        })
        .then(data => {
            if (data.success && data.data) {
                const update = data.data;
                const updateMessage = `Neue Version: ${update.version} 
                    <button onclick="startUpdate('${update.download_url}', '${update.version}')">Jetzt aktualisieren</button>`;
                document.getElementById('updateMessage').innerHTML = updateMessage;
            } else {
                document.getElementById('updateMessage').innerHTML = 'Keine neuen Updates verfügbar.';
            }
        })
        .catch(error => {
            console.error('Update-Check fehlgeschlagen:', error);
            document.getElementById('updateMessage').innerHTML = 'Fehler beim Update-Check.';
        });
}

function startUpdate(downloadUrl, version) {
    console.log('Update starten...');

    // Hier sollte der Update-Prozess gestartet werden
    fetch(`../admin/inc/update_installer.php?download_url=${encodeURIComponent(downloadUrl)}&version=${encodeURIComponent(version)}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Fehler beim Abrufen des Update-Skripts');
            }
            return response.text();
        })
        .then(data => {
            console.log('Update-Antwort:', data);
            alert('Update erfolgreich abgeschlossen!');
            location.reload(); // Seite neu laden, um die neue Version zu zeigen
        })
        .catch(error => {
            console.error('Fehler beim Starten des Updates:', error);
            alert('Update fehlgeschlagen: ' + error.message);
        });
}

// Initialer Check
checkForUpdates();
// Optional: regelmäßiger Check
setInterval(checkForUpdates, 10000);