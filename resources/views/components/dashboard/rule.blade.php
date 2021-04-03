<li class="list-group-item py-4">
    <!-- Title -->
    <div class="input-group mb-4">
        <label class="w-100" for="title_{{ $id }}">Title</label>
        <input autofocus autocomplete="off" class="form-control" type="text" id="title_{{ $id }}" name="title_{{ $id }}" <?= isset($title) ? "value='$title'" : '' ?> />
    </div>

    <!-- Description -->
    <div class="input-group">
        <div class="input-group">
            <label class="w-100" for="description_{{ $id }}">Description</label>
            <textarea autocomplete="false" class="form-control" id="description_{{ $id }}" name="description_{{ $id }}">{{ $slot }}</textarea>
        </div>
    </div>
</li>