# Docker Compose Configuration

This project uses Docker Compose to set up a full-stack application with a frontend, API, and PostgreSQL database.

## Services

### 1. **Frontend**
- **Build context**: `./build`
- **Ports**: Exposes port `3000` for the React or other frontend application.
- **Network**: Connected to `app-network`.

### 2. **API**
- **Build context**: `./api`
- **Ports**: Exposes port `8080` for the API service.
- **Depends on**: The `db` service (PostgreSQL) must be running before the API starts.
- **Network**: Connected to `app-network`.

### 3. **Database (PostgreSQL)**
- **Image**: Uses the official `postgres` image.
- **Restart policy**: Always restart if the container stops.
- **Ports**: Exposes port `5432` for database access.
- **Environment**: Sets `POSTGRES_PASSWORD` to `password`.
- **Volumes**: Loads an initialization script from `./db/init.sql` into the container.
- **Network**: Connected to `app-network`.

## Network
- **app-network**: A custom bridge network to facilitate communication between services.

## Usage

To start the application, run:

```bash
docker-compose up
