document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById("update-btn");
    const versionSpan = document.getElementById("app-version");
    const statusDiv = document.getElementById("update-status");
    const modalBody = document.getElementById('modal-body');

    if (!btn || !versionSpan || !modalBody) {
        console.error("Ein oder mehrere benötigte HTML-Elemente wurden nicht gefunden!");
        return;
    }

    btn.addEventListener("click", function () {
        const projektname = versionSpan.getAttribute("data-projektname")?.trim();
        const aktuelleVersion = versionSpan.getAttribute("data-version")?.trim();

        if (!projektname || !aktuelleVersion) {
            modalBody.innerHTML = "❌ Projektname oder aktuelle Version fehlen.";
            return;
        }

        modalBody.innerHTML = "🔄 Überprüfe Update... Bitte warten.";
        const updateModal = new bootstrap.Modal(document.getElementById('updateModal'));
        updateModal.show();

        // API zur Überprüfung auf Updates anfragen
        fetch(`/portfolio/components/api/proxy_check_update.php?projekt=${encodeURIComponent(projektname)}&current_version=${encodeURIComponent(aktuelleVersion)}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Kein Update verfügbar (Antwort leer)
                    if (!data.data || !data.data.version) {
                        modalBody.innerHTML = "✅ Kein Update verfügbar. Du hast bereits die neueste Version.";
                        return;
                    }

                    const neueVersion = data.data.version?.trim();
                    const downloadUrl = data.data.download_url;

                    if (compareVersions(neueVersion, aktuelleVersion) > 0 && downloadUrl) {
                        modalBody.innerHTML = `⬇️ Update auf Version ${neueVersion} wird gestartet...`;
                        const installerUrl = `https://webdesign.digitaleseele.at/portfolio/admin/inc/update_installer.php?projektname=${encodeURIComponent(projektname)}&version=${encodeURIComponent(neueVersion)}&download_url=${encodeURIComponent(downloadUrl)}`;

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
                } else {
                    modalBody.innerHTML = `❌ Fehler bei der Updateprüfung: ${data.error || 'Unbekannter Fehler'}`;
                }
            })
            .catch(error => {
                modalBody.innerHTML = "❌ Fehler bei der Updateprüfung: " + error;
            });
    });

    // Vergleichsfunktion für Versionsnummern (semver-artig)
    function compareVersions(v1, v2) {
        const a = v1.split('.').map(Number);
        const b = v2.split('.').map(Number);
        for (let i = 0; i < Math.max(a.length, b.length); i++) {
            const num1 = a[i] || 0;
            const num2 = b[i] || 0;
            if (num1 > num2) return 1;
            if (num1 < num2) return -1;
        }
        return 0;
    }
});