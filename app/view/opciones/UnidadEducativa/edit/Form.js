Ext.define('sisscsj.view.opciones.UnidadEducativa.edit.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.opciones.unidadeducativa.edit.form',
    requires: [
        'Ext.form.FieldContainer',
        'Ext.form.field.Text',
        'Ext.form.field.ComboBox',
        'sisscsj.ux.form.field.RemoteComboBox'
    ],
    bodyPadding: 5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            fieldDefaults: {
                allowBlank: false,
                labelAlign: 'top',
                flex: 1,
                margins: 5
            },
            defaults: {
                layout: 'hbox',
                margins: '0 10 0 10'
            },
            items: [
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'textfield',
                            name: 'nombre_unidad_educativa',
                            fieldLabel: 'Nombre de Unidad Educativa'
                        },
                        {
                            xtype: 'textfield',
                            name: 'telefono_unidad_educativa',
                            fieldLabel: 'Teléfono de Unidad Educativa',
                            allowBlank: true
                        }                        
                    ]
                },
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'textareafield',
                            name: 'direccion_unidad_educativa',
                            fieldLabel: 'Dirección Unidad Educativa',
                            height: 200,
                            allowBlank: true
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});