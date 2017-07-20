Ext.define('sisscsj.view.beneficiario.search.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.beneficiario.search.form',
    requires: [
        'Ext.form.FieldContainer',
        'Ext.form.FieldSet',
        'Ext.form.field.Date',
        'Ext.form.field.Text',
        'Ext.form.field.ComboBox',
        'Ext.slider.Multi',
        'sisscsj.ux.form.field.RemoteComboBox',
        'sisscsj.ux.form.field.plugin.ClearTrigger'
    ],
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            fieldDefaults: {
                labelAlign: 'top',
                flex: 1,
                margins: 5
            },
            items: [
                {
                    xtype: 'fieldset',
                    title: 'Detalles del Beneficiario',
                    collapsible: true,
                    items: [
                        {
                            xtype: 'fieldcontainer',
                            layout: 'hbox',
                            items: [
                                {
                                    xtype: 'textfield',
                                    name: 'codigo_beneficiario',
                                    fieldLabel: 'Código:'
                                },
                                {
                                    xtype: 'textfield',
                                    name: 'primer_nombre_beneficiario',
                                    fieldLabel: 'Primer Nombre:'
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            layout: 'hbox',
                            items: [
                                {
                                    xtype: 'textfield',
                                    name: 'apellido_paterno_beneficiario',
                                    fieldLabel: 'Apellido Paterno:'
                                },
                                {
                                    xtype: 'textfield',
                                    name: 'apellido_materno_beneficiario',
                                    fieldLabel: 'Apellido Materno:'
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            layout: 'hbox',
                            items: [
                                {
                                    xtype: 'ux.form.field.remotecombobox',
                                    name: 'fk_id_nivel',
                                    itemId: 'fk_id_nivel',
                                    fieldLabel: 'Nivel:',
                                    displayField: 'nombre_nivel',
                                    valueField: 'id_nivel',
                                    editable: false,
                                    store: {
                                        type: 'opciones.nivel'
                                    },
                                    plugins: [
                                        { ptype: 'cleartrigger' }
                                    ],
                                    forceSelection: true,
                                    allowBlank: true
                                },
                                {
                                    xtype: 'ux.form.field.remotecombobox',
                                    name: 'fk_id_curso',
                                    itemId: 'fk_id_curso',
                                    fieldLabel: 'Curso:',
                                    displayField: 'nombre_curso',
                                    valueField: 'id_curso',
                                    editable: false,
                                    disabled: true,
                                    store: {
                                        type: 'opciones.curso'
                                    },
                                    plugins: [
                                        { ptype: 'cleartrigger' }
                                    ],
                                    forceSelection: true,
                                    allowBlank: true
                                }
                            ]
                        },
                        // Fede
                        {
                            xtype: 'fieldcontainer',
                            layout: 'hbox',
                            items: [
                                {
                                    xtype: 'combo',
                                    name: 'sexo_beneficiario',
                                    fieldLabel: 'Sexo:',
                                    displayField: 'nombre',
                                    valueField: 'valor',
                                    store: new Ext.data.SimpleStore({
                                        fields: ['nombre', 'valor'],
                                        data: [['Femenino', 'f'], ['Masculino', 'm']]
                                    }),
                                    plugins: [
                                        {ptype: 'cleartrigger'}
                                    ],
                                    editable: false,
                                    forceSelection: true,
                                    allowBlank: false
                                },
                                {
                                    xtype: 'ux.form.field.remotecombobox',
                                    name: 'fk_id_donante',
                                    itemId: 'fk_id_donante',
                                    fieldLabel: 'Donante:',
                                    displayField: 'nombre_donante',
                                    valueField: 'id_donante',
                                    editable: false,
                                    store: {
                                        type: 'opciones.donante'
                                    },
                                    plugins: [
                                        { ptype: 'cleartrigger' }
                                    ],
                                    forceSelection: true,
                                    allowBlank: true
                                },
                                {
                                    xtype: 'datefield',
                                    name: 'fecha_nacimiento_beneficiario',
                                    fieldLabel: 'Fecha de Nacimiento',
                                    format: 'Y-m-d',
                                    submitFormat: 'Y-m-d'
                                }
                            ]
                        }
                    ]
                }
            ]
        });
        me.callParent( arguments );
    }
});