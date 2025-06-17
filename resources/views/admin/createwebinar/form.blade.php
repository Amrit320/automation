<div class="mb-3">
    <label>Title</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $webinar->title ?? '') }}">
</div>

<div class="mb-3">
    <label>Description</label>
    <textarea name="description" class="form-control">{{ old('description', $webinar->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>Topic</label>
    <input type="text" name="topic" class="form-control" value="{{ old('topic', $webinar->topic ?? '') }}">
</div>

<div class="mb-3">
    <label>Date</label>
    <input type="date" name="date" class="form-control" value="{{ old('date', $webinar->date ?? '') }}">
</div>

<div class="mb-3">
    <label>Time</label>
    <input type="time" name="time" class="form-control" value="{{ old('time', $webinar->time ?? '') }}">
</div>

<div class="mb-3">
    <label>Reminder Times</label>
    <div id="reminder-time-wrapper">
        <div class="d-flex mb-2">
            <input type="time" class="form-control reminder-time" />
            <button type="button" class="btn btn-danger ms-2 remove-time-btn">✖</button>
        </div>
    </div>
    <button type="button" class="btn btn-sm btn-primary" id="add-reminder-time">+ Add Reminder</button>
    <input type="hidden" name="reminder_reminder_time" id="reminder_reminder_time" value="{{ old('reminder_reminder_time', $webinar->reminder_reminder_time ?? '') }}">
</div>

<div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-control">
        <option value="active" {{ old('status', $webinar->status ?? '') === 'active' ? 'selected' : '' }}>Active</option>
        <option value="inactive" {{ old('status', $webinar->status ?? '') === 'inactive' ? 'selected' : '' }}>Inactive</option>
    </select>
</div>

<div class="mb-3">
    <label>Speakers</label>
    <input type="text" name="speakers" class="form-control" value="{{ old('speakers', $webinar->speakers ?? '') }}">
</div>

<div class="mb-3">
    <label>Speakers Designation</label>
    <input type="text" name="speakers_designation" class="form-control" value="{{ old('speakers_designation', $webinar->speakers_designation ?? '') }}">
</div>

<div class="mb-3">
    <label>Zoom Meeting ID</label>
    <input type="text" name="zoom_meeting_id" class="form-control" value="{{ old('zoom_meeting_id', $webinar->zoom_meeting_id ?? '') }}">
</div>

<div class="mb-3">
    <label>Zoom Meeting URL</label>
    <input type="url" name="zoom_meeting_url" class="form-control" value="{{ old('zoom_meeting_url', $webinar->zoom_meeting_url ?? '') }}">
</div>

<div class="mb-3">
    <label>Banner (Image)</label>
    <input type="file" name="banner" class="form-control">
    @if (!empty($webinar->banner))
    <p class="mt-2"><strong>Current Banner:</strong><br>
        <img src="{{ asset('storage/' . $webinar->banner) }}" style="max-width: 200px;" alt="Banner">
    </p>
    @endif
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const wrapper = document.getElementById("reminder-time-wrapper");
        const addBtn = document.getElementById("add-reminder-time");
        const hiddenInput = document.getElementById("reminder_reminder_time");
        const form = document.querySelector("form");
        const dateInput = document.querySelector("input[name='date']");

        // Add new time input
        addBtn.addEventListener("click", () => {
            const group = document.createElement("div");
            group.className = "d-flex mb-2";
            group.innerHTML = `
                <input type="time" class="form-control reminder-time" />
                <button type="button" class="btn btn-danger ms-2 remove-time-btn">✖</button>
            `;
            wrapper.appendChild(group);
        });

        // Remove time input
        wrapper.addEventListener("click", (e) => {
            if (e.target.classList.contains("remove-time-btn")) {
                e.target.closest(".d-flex").remove();
            }
        });

        // Before form submit: build hidden input value
        form.addEventListener("submit", () => {
            const date = dateInput.value;
            const times = [];

            if (!date) {
                alert("Please select a webinar date before adding reminder times.");
                return;
            }

            wrapper.querySelectorAll(".reminder-time").forEach(input => {
                if (input.value) {
                    const formatted = `${date} ${input.value}:00`;
                    times.push(`"${formatted}"`);
                }
            });

            hiddenInput.value = `[${times.join(",")}]`;
        });
    });
</script>