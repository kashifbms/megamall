import Edit from './edit';

wp.blocks.registerBlockType("megamall/hero-slider", {
    edit: Edit,
    save() {
        return null;
    }
});