const createEmptySlide = () => ({
    imageId: null,
    imageUrl: '',

    infoTimingTitle: '',
    infoTimingText: '',

    infoLocationTitle: '',
    infoLocationCtaLabel: '',
    infoLocationCtaUrl: '',

    showInfoBox: true
});

import { __ } from '@wordpress/i18n';
import {
    InspectorControls,
    MediaUpload,
    MediaUploadCheck,
    useBlockProps,
    RichText
} from '@wordpress/block-editor';
import {
    PanelBody,
    Button,
    ToggleControl,
    RangeControl,
    TextControl,
    TextareaControl
} from '@wordpress/components';
import { Fragment } from '@wordpress/element';

export default function Edit({ attributes, setAttributes }) {
    const {
        slides = [],
        autoplay,
        speed,
        showArrows,
        showDots,
        fullHeight
    } = attributes;

    const blockProps = useBlockProps({
        className: 'mm-hero-slider-editor'
    });

    const updateSlide = (index, updates) => {
        const newSlides = slides.map((slide, i) => {
            if (i !== index) return slide;

            return {
                ...slide,
                ...updates
            };
        });

        setAttributes({ slides: newSlides });
    };

    



    const addSlide = () => {
        setAttributes({
            slides: [...slides, createEmptySlide()]
        });
    };


    const removeSlide = (index) => {
        const newSlides = slides.filter((_, i) => i !== index);
        setAttributes({ slides: newSlides });
    };


    const moveSlide = (from, to) => {
        if (to < 0 || to >= slides.length) return;

        const newSlides = [...slides];
        const item = newSlides.splice(from, 1)[0];
        newSlides.splice(to, 0, item);

        setAttributes({ slides: newSlides });
    };


    return (
        <Fragment>
            <InspectorControls>
                <PanelBody title={__('Slider Settings', 'mega-mall')} initialOpen={true}>
                    <ToggleControl
                        label={__('Autoplay', 'mega-mall')}
                        checked={autoplay}
                        onChange={(val) => setAttributes({ autoplay: val })}
                    />
                    <RangeControl
                        label={__('Autoplay Speed (ms)', 'mega-mall')}
                        value={speed}
                        min={1000}
                        max={10000}
                        step={500}
                        onChange={(val) => setAttributes({ speed: val })}
                    />
                    <ToggleControl
                        label={__('Show Arrows', 'mega-mall')}
                        checked={showArrows}
                        onChange={(val) => setAttributes({ showArrows: val })}
                    />
                    <ToggleControl
                        label={__('Show Dots', 'mega-mall')}
                        checked={showDots}
                        onChange={(val) => setAttributes({ showDots: val })}
                    />
                    <ToggleControl
                        label={__('Full Height (100vh)', 'mega-mall')}
                        checked={fullHeight}
                        onChange={(val) => setAttributes({ fullHeight: val })}
                    />
                    <ToggleControl
                        label="Medium height (max 500px)"
                        checked={ attributes.mediumHeight }
                        onChange={(value) => {
                            setAttributes({
                            mediumHeight: value,
                            fullHeight: value ? false : attributes.fullHeight,
                            });
                        }}
                    />


                </PanelBody>
            </InspectorControls>

            <div {...blockProps}>
                {slides.length === 0 && (
                    <div className="mm-hero-empty">
                        <p>{__('No slides yet. Add your first hero slide.', 'mega-mall')}</p>
                        <Button variant="primary" onClick={addSlide}>
                            {__('Add Slide', 'mega-mall')}
                        </Button>
                    </div>
                )}

                {slides.map((slide, index) => (
                    <div className="mm-hero-slide-editor" key={index}>
                        <div className="mm-hero-slide-header">
                            <strong>{__('Slide', 'mega-mall')} #{index + 1}</strong>
                            <div className="mm-hero-slide-actions">
                                <Button
                                    size="small"
                                    onClick={() => moveSlide(index, -1)}
                                    disabled={index === 0}
                                >
                                    ↑
                                </Button>
                                <Button
                                    size="small"
                                    onClick={() => moveSlide(index, 1)}
                                    disabled={index === slides.length - 1}
                                >
                                    ↓
                                </Button>
                                <Button
                                    isDestructive
                                    size="small"
                                    onClick={() => removeSlide(index)}
                                >
                                    {__('Remove', 'mega-mall')}
                                </Button>
                            </div>
                        </div>

                        <div className="mm-hero-slide-body">
                            <div className="mm-hero-slide-image">
                                <MediaUploadCheck>
                                    <MediaUpload
                                        onSelect={(media) => {
                                            updateSlide(index, {
                                                imageId: media.id,
                                                imageUrl: media.url
                                            });
                                        }}
                                        allowedTypes={['image']}
                                        value={slide.imageId}
                                        render={({ open }) => (
                                            <Button onClick={open} className="button button-large">
                                                {slide.imageUrl
                                                    ? __('Change Background Image', 'mega-mall')
                                                    : __('Select Background Image', 'mega-mall')}
                                            </Button>
                                        )}
                                    />
                                </MediaUploadCheck>
                                {slide.imageUrl && (
                                    <div className="mm-hero-image-preview">
                                        <img src={slide.imageUrl} alt="" />
                                    </div>
                                )}
                            </div>

                            <div className="mm-hero-slide-info">
                                <ToggleControl
                                    label={__('Show Info Box on this slide', 'mega-mall')}
                                    checked={!!slide.showInfoBox}
                                    onChange={(val) => updateSlide(index, { showInfoBox: Boolean(val) })}
                                />

                                {slide.showInfoBox !== false && (
                                    <>
                                        <TextControl
                                            label={__('Timing Title', 'mega-mall')}
                                            value={slide.infoTimingTitle || ''}
                                            onChange={(val) =>
                                                updateSlide(index, 'infoTimingTitle', val)
                                            }
                                        />
                                        <TextareaControl
                                            label="Timing Text"
                                            value={typeof slide.infoTimingText === 'string' ? slide.infoTimingText : ''}
                                            onChange={(val) => updateSlide(index, { infoTimingText: val })}

                                        />


                                        <TextControl
                                            label={__('Location Title', 'mega-mall')}
                                            value={slide.infoLocationTitle || ''}
                                            onChange={(val) =>
                                                updateSlide(index, 'infoLocationTitle', val)
                                            }
                                        />
                                        <TextControl
                                            label={__('Location CTA Label', 'mega-mall')}
                                            value={slide.infoLocationCtaLabel || ''}
                                            onChange={(val) =>
                                                updateSlide(index, 'infoLocationCtaLabel', val)
                                            }
                                        />
                                        <TextControl
                                            label={__('Location CTA URL', 'mega-mall')}
                                            value={slide.infoLocationCtaUrl || ''}
                                            onChange={(val) => updateSlide(index, { infoLocationCtaUrl: val })}

                                        />
                                    </>
                                )}
                            </div>
                        </div>
                    </div>
                ))}

                {slides.length > 0 && (
                    <div className="mm-hero-add-more">
                        <Button variant="secondary" onClick={addSlide}>
                            {__('Add Another Slide', 'mega-mall')}
                        </Button>
                    </div>
                )}
            </div>
        </Fragment>
    );
}