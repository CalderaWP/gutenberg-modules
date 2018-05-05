import {TextControl} from "@awordpress/components";
import React, { Component } from 'react';

export const ExampleComponent = (props) => {
    return (
        <TextControl
            label={ 'This is a Gutenberg Text Control' }
            value={ props.value }
            onChange={ props.onChange }
        />
    )
}