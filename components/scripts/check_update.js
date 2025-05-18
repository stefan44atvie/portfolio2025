document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById("update-btn");
    const versionSpan = document.getElementById("app-version");
    const statusDiv = document.getElementById("update-status");
    const modalBody = document.getElementById('modal-body');

    // Überprüfen, ob alle benötigten Elemente existieren
    if (!btn || !versionSpan || !modalBody) {
        console.error("Ein oder mehrere benötigte HTML-Elemente wurden nicht gefunden!");
        return;
    }

    btn.addEventListener("click", function () {
        const projektname = versionSpan.getAttribute("data-projektname");
        const aktuelleVersion = versionSpan.getAttribute("data-version");

        // Ladeanzeige starten
        modalBody.innerHTML = "🔄 Überprüfe Update... Bitte warten.";

        const updateModal = new bootstrap.Modal(document.getElementById('updateModal'));
        updateModal.show();

        // 🔧 Fester Pfad für Projektstruktur unter /portfolio2025
        const basePath = "/portfolio2025";

        // 🔍 Updateprüfung starten
        fetch(`${basePath}/components/api/proxy_check_update.php?projekt=${encodeURIComponent(projektname)}&current_version=${encodeURIComponent(aktuelleVersion)}`)
            .then(response => response.json())
            .then(data => {
                if (data.success && data.data.version !== aktuelleVersion) {
                    const neueVersion = data.data.version;
                    const downloadUrl = data.data.download_url;

                    modalBody.innerHTML = `⬇️ Update auf Version ${neueVersion} wird gestartet...`;

                    // 🔧 Lokaler Pfad für Update-Installer
                    const installerUrl = `${basePath}/admin/inc/update_installer.php?projektname=${encodeURIComponent(projektname)}&version=${encodeURIComponent(neueVersion)}&download_url=${encodeURIComponent(downloadUrl)}`;

                    fetch(installerUrl)
                        .then(r => r.text())
                        .then(output => {
                            modalBody.innerHTML = `<pre>${output}</pre>`;

                            if (output.includes("Update erfolgreich")) {
                                const reloadBtn = document.getElementById('reload-btn');
                                if (reloadBtn) {
                                    reloadBtn.style.display = 'inline-block';
                                    reloadBtn.addEventListener('click', () => {
                                        location.reload();
                                    });
                                }
                            }
                        })
                        .catch(err => {
                            modalBody.innerHTML = `❌ Fehler beim Ausführen des Updates: ${err}`;
                        });
                } else {
                    modalBody.innerHTML = "✅ Kein Update verfügbar oder bereits aktuell.";
                }
            })
            .catch(error => {
                modalBody.innerHTML = "❌ Fehler bei der Updateprüfung: " + error;
            });
    });
});