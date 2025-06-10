# C.R.A.B Portal - Clicker Game

Dette er et enkelt nettspill kalt **Clicker Game**, utviklet med PHP, HTML, CSS og JavaScript. Spillet lar brukere klikke for å øke poengsum, lagre resultatet i en database, og vise en highscore-liste. 

## Innhold i prosjektet

- **index.php** – Portalens startside med lenke til clicker-spillet.
- **clicker_game.php** – Selve clicker-spillet med poengtelling og innsending av score.
- **highscore.php** – Viser highscore-tabell med spillernes poeng.
- **faq.php** – Enkel FAQ-side.
- **register.php** – Registreringsside for nye brukere.
- **sign_in.php** – Påloggingsside.
- **logout.php** – Logger ut brukeren.
- **submit_score.php** – Skript for å lagre score i databasen.
- **style.css** – Stylesheet for hele portalen (ikke vist her).

## Database

Prosjektet bruker en MySQL/MariaDB database med navn `crab_game` som hostes på en Ubuntu VM i Hyper-V.

### Tabellen `users`

- `id` (int, auto_increment, primary key)
- `username` (varchar)
- `password` (varchar) – OBS: passord er foreløpig ikke hashet.
- `email` (varchar)

### Tabellen `highscore`

- `id` (int, auto_increment, primary key)
- `player` (varchar)
- `score` (int)

## Hosting og tilkobling

- VM med Ubuntu OS kjører database-server.
- IP hjemme: `192.168.4.95`
- IP skole: `10.2.3.101`
- Tilgang via SSH for administrasjon.

## Hvordan bruke

1. Pakk hele mappen `C.R.A.B_Portal` inn i webserverens rotmappe (f.eks. `/var/www/html`).
2. Konfigurer `db_connect.php` med riktig database-tilkobling.
3. Åpne `index.php` i nettleseren for å starte.
4. Registrer ny bruker eller logg inn.
5. Spill Clicker Game, klikk for poeng, og send inn score.
6. Se highscore-listen under "Highscore" i menyen.


## FAQ

**Hvordan registrerer jeg meg?**  
Gå til `register.php` og fyll ut brukernavn, e-post og passord. Passord må være minst 8 tegn.

**Hvordan logger jeg inn?**  
Bruk `sign_in.php` og skriv inn brukernavn og passord.

**Hvordan fungerer Clicker Game?**  
Du klikker på knappen "Click me!" for å øke poengsummen. Når du er ferdig, kan du skrive inn navnet ditt og sende inn poengsummen til highscore-listen.

**Hvor lagres poengene?**  
Poengene lagres i databasen i tabellen `highscore` sammen med navnet du oppgir.

**Hva skjer hvis jeg logger ut?**  
Sessionen din slettes og du må logge inn igjen for å få tilgang til brukerfunksjoner.

---

**C.R.A.B Portal** – enkel portal med spill og brukerstøtte laget som skoleprosjekt.

**Kontakt** – Email meg på khelyounis123@gmail.com for spørsmål om nettsiden eller mulige ting å fikse med nettsiden!
