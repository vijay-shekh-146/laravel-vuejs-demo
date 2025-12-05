<template>
  <div class="container py-4">

    <!-- Page Header -->
    <div class="text-center mb-4">
      <h2 class="fw-bold">Team Builder</h2>
      <p class="text-muted">Drag and drop Team Player Demo</p>
    </div>

    <!-- Players Section -->
    <div class="card shadow-sm mb-4 border-0">
      <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Players</h5>
      </div>

      <div class="card-body">

        <draggable
          v-model="pending_players"
          :group="{ name: 'players', pull: 'clone', put: true }"
          item-key="id"
          class="list-group player-box"
          :ghost-class="'ghost'"
        >
          <template #item="{ element }">
            <div class="list-group-item player-item d-flex justify-content-between align-items-center">
              <div>
                <strong>{{ element.name }}</strong>
                <div class="text-muted small">{{ element.email }} - {{ element.dob }}</div>
              </div>
            </div>
          </template>

          <template #footer>
            <div v-if="pending_players.length === 0" class="text-center text-muted py-2">
              No players available
            </div>
          </template>

        </draggable>

      </div>
    </div>

    <!-- Teams Section -->
    <div class="row g-4">
      <div v-for="team in teams" :key="team.id" class="col-md-4">
        <div class="card shadow-sm border-0 team-card">

          <div class="card-header bg-dark text-white">
            <h5 class="mb-0">{{ team.name }}</h5>
            <small class="text-light">{{ team.state }}, {{ team.country }}</small>
          </div>

          <div class="card-body">

            <draggable
              v-model="team.players"
              :group="{ name: 'players', pull: true, put: true }"
              item-key="id"
              class="list-group team-player-box"
              @change="onDragChange"
            >

              <template #item="{ element, index }">
                <div class="list-group-item team-player-item d-flex justify-content-between align-items-center">
                  <div>
                    <strong>{{ element.name }}</strong>
                    <div class="small text-muted">{{ element.email }}</div>
                  </div>
                  <button class="btn btn-sm btn-outline-danger" @click.prevent="removePlayerTeam(team, index)">
                    Remove
                  </button>
                </div>
              </template>

              <template #footer>
                <div v-if="team.players.length === 0" class="text-center text-muted py-2">
                  Drop players here
                </div>
              </template>

            </draggable>

          </div>

        </div>
      </div>
    </div>

    <!-- Buttons -->
    <div class="mt-4 text-center">
      <button class="btn btn-success px-4" @click="save" :disabled="saving">
        <span v-if="saving">Saving...</span>
        <span v-else>Save</span>
      </button>

      <button class="btn btn-outline-secondary px-4 ms-2" @click="reload" :disabled="loading">
        Reload
      </button>
    </div>

  </div>
</template>

<script>
import axios from 'axios';
import draggable from 'vuedraggable';
import { toastSuccess, toastError } from "./utils/toast";


export default {
    name: 'App',
    components: { draggable },
    data() {
        return {
            teams: [],
            pending_players: [],
            loading: false,
            saving: false,
        };
    },
    mounted() {
        this.load();
    },
    methods: {
        async load() {
            this.loading = true;
            try {
                const res = await axios.get('/api/get-team-players');
                const { teams, pending_players } = res.data.data;

                this.teams = teams;
                this.pending_players = pending_players;
            }
            catch (err) {
                console.error(err);
                toastError('Failed to load data.');
            } finally {
                this.loading = false;
            }
        },

        onDragChange(event) {
            if (event.added) {
                const player = event.added.element;
                this.pending_players = this.pending_players.filter(p => p.id !== player.id);
            }
        },

        async save() {
            this.saving = true;
            try {

                const payload = {
                    teams: this.teams.map(team => ({
                        id: team.id,
                        players: team.players.map(player => player.id),
                    })),
                };

                 const response = await axios.post('/api/store-team-players', payload);
                toastSuccess(response.data.message);
            } catch (err) {
                toastError(err.response.data.message);
            } finally {
                this.saving = false;
            }
        },
        reload() {
            this.load();
        },

        removePlayerTeam(team, index) {
            const player = team.players.splice(index, 1)[0];
            this.pending_players.push(player);
        },
    }
}
</script>

<style>
.teams-grid { gap: 16px; }
.team-box { min-height: 180px; }
.list-group { min-height: 60px; max-height: 420px; overflow-y: auto; }
.ghost { opacity: 0.5; }
</style>
