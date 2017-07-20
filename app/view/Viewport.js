Ext.define('sisscsj.view.Viewport', {
    extend: 'Ext.container.Viewport',
    requires:[
        'Ext.layout.container.Border',
        'sisscsj.view.layout.North',
        'sisscsj.view.layout.West',
        'sisscsj.view.layout.Center'
    ],
    layout: {
        type: 'border'
    },
    items: [
        {xtype: 'layout.north'},
        {xtype: 'layout.west'},
        {xtype: 'layout.center'}
    ]
});
