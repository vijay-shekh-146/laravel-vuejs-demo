#  Drag & Drop Team Builder (Laravel + Vue.js)

A fully interactive **Drag & Drop Player Assignment System** built using **Laravel API** and **Vue.js (vuedraggable)**.

Users can drag players into teams, reorder them, remove them back to the unassigned list, and save all assignments using API calls.

---

#  Features

-  List of all **unassigned players**
-  Multiple **Team boxes**
-  Drag & Drop players across teams
-  Support for **sorting players inside a team**
-  Removing a player adds them back to unassigned list
-  Save button to store assignments in the pivot table
-  Load saved teams & players on page load

---

#  Tech Stack

| Layer     | Technology |
|-----------|------------|
| Backend   | Laravel 11 |
| Frontend  | Vue.js 3 + vuedraggable |
| Database  | MySQL/PostgreSQL |
| API Auth  | (Optional) Sanctum / JWT |

---

### Implement Drag & Drop (Vue.js)
- Unassigned Players list
- Team boxes
- Drag → drop players
- Sort inside team
- Remove returns to unassigned list
- Save to DB

---

#  Installation & Setup

## 1️⃣ Clone Repository
```bash
git clone GIT_URL
cd FOLDER_NAME
```

## 2️⃣ Install Composer Dependencies
```bash
composer install
```

## 3️⃣ Configure `.env`
```env
DB_DATABASE=drag_drop
DB_USERNAME=root
DB_PASSWORD=
```

## 4️⃣ Run Migrations & Seeders
```bash
php artisan migrate --seed
```

## 5️⃣ Start Backend Server
```bash
php artisan serve
```

---

#  Frontend Setup

## Install Node Packages
```bash
npm install
```

## Run Dev Server
```bash
npm run dev
```

App runs at:
```
http://localhost:8000
```

---

#  API Endpoints

### GET `/api/get-team-players`
Returns teams + unassigned players.

### POST `/api/store-team-players`
Payload:
```json
{
  "teams": [
    { "id": 1, "players": [3, 7, 9] },
    { "id": 2, "players": [1, 5] }
  ]
}
```

---

#  Database Structure

```
teams
players
player_team
```

---

#  Optional Enhancements
- Player search
- Filters (state/country)
- Avatar images
- Undo/redo actions

---

#  License
Open-source and free to use.
