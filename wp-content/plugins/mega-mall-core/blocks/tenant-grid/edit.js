import { InspectorControls } from "@wordpress/block-editor";
import { PanelBody, RangeControl } from "@wordpress/components";
import { __ } from "@wordpress/i18n";

const Edit = ({ attributes, setAttributes }) => {
  const { postsPerPage } = attributes;

  return (
    <>
      <InspectorControls>
        <PanelBody title={__('Grid Settings', 'mega-mall')} initialOpen={true}>
          <RangeControl
            label={__('Tenants per page', 'mega-mall')}
            value={postsPerPage}
            min={4}
            max={48}
            onChange={(value) =>
              setAttributes({ postsPerPage: value })
            }
          />
        </PanelBody>
      </InspectorControls>

      <div className="mm-block-placeholder">
        <strong>Tenants Grid</strong>
        <p>Tenants will render on the frontend.</p>
        <p>Tenants per page: {postsPerPage}</p>
      </div>
    </>
  );
};

export default Edit;