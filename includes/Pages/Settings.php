<!-- Slider Settings -->
<div class="tab-content" id="tab-settings" style="display: none;">

  <!-- Select Control for Slider Type -->
  <div class="control-group">
    <p for="slider-type">Slider Type</p>
    <select id="slider-type">
      <option value="horizontal">Horizontal</option>
      <option value="fade">Fade</option>
      <option value="vertical">Vertical</option>
    </select>
  </div>

  <!-- Number Input Controls -->
  <div class="control-group">
    <p>Max Width (px)</p>
    <input type="number" id="max-width" placeholder="Enter max width" />
  </div>

  <div class="control-group">
    <p>Transition Duration (ms)</p>
    <input type="number" id="transition-duration" placeholder="Enter duration in milliseconds" />
  </div>

  <div class="control-group">
    <p>Height (px)</p>
    <input type="number" id="slider-height" placeholder="Enter slider height" />
  </div>

  <!-- Toggle Controls -->
  <div class="control-group">
    <p>Enable Controls</p>
    <label class="switch">
      <input type="checkbox" id="controls-enabled" />
      <span class="slider round"></span>
    </label>
  </div>

  <div class="control-group">
    <p>Enable Pagination</p>
    <label class="switch">
      <input type="checkbox" id="pagination-enabled" />
      <span class="slider round"></span>
    </label>
  </div>

  <!-- Save Settings Button -->
  <div class="control-group save-settings-button">
    <button id="save-settings" class="save-settings-btn">Save Settings</button>
  </div>

</div>