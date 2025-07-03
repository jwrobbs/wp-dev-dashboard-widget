# WP Dev Dashboard Widget

## Overview
A WordPress plugin that creates a framework for building a multisection dashboard widget with capabilities like table display, collapsible sections, and AJAX buttons

## File Structure
/plugin folder
    -- /assets (shared assets)
    -- /modules (each module will have its own folder)
        --- /module example
            ---- /src
            ---- /hooks
            ---- /ajax
            ---- hooks.php
            ---- init.php
    -- main file
    -- hooks file
    -- updater file

## Features
- Development has 5 sections: framework (FW), display (D), modules (M), AJAX (A), and Updater (U)
- FW: The framework will have the classes and hook needed for a module based system to inject new sections.
- D: Display will display the data from the modules. Options include:
    - Table
    - List
    - Button
    - Need a way to send the button data to be displayed in a table, etc
- D: Each section will have a title, a toggle, content, and a bottom border.
- M: Modules/ will provide data. 
- A: We will add buttons via hooks? 
- A: The ajax fns will be in the module's folder.
- A: the module will have a hooks file. The framework will check each module for a hooks file and load it if it exists.
- U: create updated to update from GitHub
    - URL: https://github.com/jwrobbs/wp-dev-dashboard-widget


## Task List
- [ ] Create /assets directory for shared assets
- [ ] Create /modules directory for modules
- [ ] Create main plugin file (wp-dev-dashboard-widget.php)
- [ ] Implement dynamic module loading in main plugin file
- [ ] Create dashboard widget registration and framework (sections, toggles, etc.)
- [ ] Create hooks file if needed
- [ ] Create updater file for GitHub updates
- [ ] Create empty license file
- [ ] Implement AJAX handler structure per module with security (nonces/capabilities)
- [ ] Implement section display types (table, list, button) in dashboard widget framework
- [ ] Add basic documentation (README.md)
- [ ] Add inline code comments
- [ ] Add basic test instructions or test cases (optional)


## Current Goal
Create /assets and /modules directories for the initial file structure.
