Ext.define('sisscsj.controller.participante.ParticipanteOcupacion', {
    extend: 'sisscsj.controller.Base',
    stores: [
        'participante.ParticipanteOcupacion'
    ],
    views: [
        'participante.ListaOcupacion',
        'participante.edit.FormOcupacion',
        'participante.edit.WindowOcupacion'
    ],
    refs: [
        {
            ref: 'ParticipanteOcupacionLista',
            selector: '[xtype=participante.listaocupacion]'
        },
        {
            ref: 'ParticipanteOcupacionWindow',
            selector: '[xtype=participante.edit.windowocupacion]'
        },
        {
            ref: 'ParticipanteOcupacionForm',
            selector: '[xtype=participante.edit.formocupacion]'
        },
        {
            ref: 'ParticipanteLista',
            selector: '[xtype=participante.lista]'
        }
    ],
    init: function() {
        this.listen({
            controller: {},
            component: {
                'grid[xtype=participante.listaocupacion]': {
                    beforerender: this.loadRecords,
                    itemdblclick: this.edit,
                    select: this.habilitarBotones,
                    delselect: this.deshabilitarBotones
                },
                'grid[xtype=participante.listaocupacion] button#add': {
                    click: this.add
                },
                'grid[xtype=participante.listaocupacion] button#edit': {
                    click: this.edit
                },
                'grid[xtype=participante.listaocupacion] button#delete': {
                    click: this.remove
                },
                'window[xtype=participante.edit.windowocupacion] button#save': {
                    click: this.save
                },
                'window[xtype=participante.edit.windowocupacion] button#cancel': {
                    click: this.close
                }
            },
            global: {},
            store: {},
            proxy: {}
        });
    },


    loadRecords: function(grid, eOpts) {
        var me = this;
        var store = grid.getStore();
        var botonEdit = grid.down("[xtype='toolbar'] button#edit");
        var botonDelete = grid.down("[xtype='toolbar'] button#delete");
        // clear any fliters that have been applied
        store.clearFilter(true);
        var contParticipante = me.getController('participante.Participante');
        
        // Si se esta editando un participante filtrar las ocupaciones por su ID
        if ( contParticipante.boolParticipanteEdit === 1)
        {
            var grid2 = me.getParticipanteLista();
            var dd = grid2.getSelectionModel().getSelection();

            if ( dd.length === 1 )
            {
                var record = dd[0];
                var data = record.getData();

                store.filter( 'fk_id_beneficiario', data['id_beneficiario'] );
            }
        }
        
        // Se deshabilita o habilita los botones de edit y delete
        // según se haya elegido un registro o no.
        var recStore = store.getRange();
        var arrRecords = grid.getSelectionModel().getSelection();

        if ( recStore.length === 0 || arrRecords.length === 0 )
        {
            botonEdit.disable();
            botonDelete.disable();
        }
    },

    
    habilitarBotones: function ( record, index, eOpts ){
        var me = this;
        var grid = me.getParticipanteOcupacionLista();
        var botonEdit = grid.down("[xtype='toolbar'] button#edit");
        var botonDelete = grid.down("[xtype='toolbar'] button#delete");

        if ( botonEdit.disabled || botonDelete.disabled )
        {
            botonEdit.enable();
            botonDelete.enable();
        }
    },


    deshabilitarBotones: function ( record, index, eOpts ){
        var me = this;
        var grid = me.getParticipanteLista();
        var records = grid.getSelectionModel().getSelection();

        if (records.length > 0)
        {
            var grid2 = me.getParticipanteOcupacionLista();
            var botonEdit = grid2.down("[xtype='toolbar'] button#edit");
            var botonDelete = grid2.down("[xtype='toolbar'] button#delete");

            botonEdit.disable();
            botonDelete.disable();
        }
    },


    cancel: function(editor, context, eOpts) {
        // if the record is a phantom, remove from store and grid
        if (context.record.phantom) {
            context.store.remove(context.record);
        }
    },


    edit: function(records, index, node, eOpts) {
        var me = this;
        var grid = me.getParticipanteOcupacionLista();
        var record = grid.getSelectionModel().getSelection()[0];
        // show window
        me.showEditWindow(record);
    },


    add: function(button, e, eOpts) {
        var me = this,
            record = Ext.create('sisscsj.model.participante.ParticipanteOcupacion');
        
        // [INICIO] Se recupera el ID del participante para asociarlo al registro de Ocupación
        var grid1 = me.getParticipanteLista();
        var recSeleccionados = grid1.getSelectionModel().getSelection();
        var contParticipante = me.getController('participante.Participante');

        // Participante ya creado
        if ( recSeleccionados.length === 1 && contParticipante.boolParticipanteEdit === 1 )
        {
            var record1 = recSeleccionados[0];
            var data1 = record1.getData();

            record.set('fk_id_beneficiario', data1['id_beneficiario']);

            me.showEditWindow(record);
        }
        else
        {
            // Participante nuevo
            if ( contParticipante.boolParticipanteEdit === 0 )
            {
                me.showEditWindow(record);
            }
            else
            {
                console.log('[ParticipanteOcupacion] Error al recuperar el ID del participante');
                return 'Error';
            }
        }
        // [FIN]
    },


    save: function(button, e, eOpts) {
        var me = this,
                grid = me.getParticipanteOcupacionLista(),
                store = grid.getStore(),
                win = button.up('window'),
                form = win.down('form'),
                record = form.getRecord(),
                values = form.getValues();

        // set values of record from form
        record.set(values);

        // check if form is even dirty...if not, just close window and stop everything...nothing to see here
        if (!record.dirty) {
            win.close();
            return;
        }

        if ( form.isValid() )
        {
            // si es nuevo registro se lo añade al store, sino se lo actualiza
            var rowIndex = store.indexOf(record);
            ( rowIndex === -1 ) ? store.add(record) : form.updateRecord(record);

            win.close();
        }
        else
        {
            Ext.Msg.alert('Error de Validación', 'Por favor revise los datos del formulario.');
            return;
        }
    },
            

    close: function(button, e, eOpts) {
        var me = this,
                win = button.up('window');
        // close the window
        win.close();
    },


    remove: function() {
        var me = this;
        var grid = me.getParticipanteOcupacionLista();
        var store = grid.getStore();
        var record = grid.getSelectionModel().getSelection()[0];
        var botonEdit = grid.down("[xtype='toolbar'] button#edit");
        var botonDelete = grid.down("[xtype='toolbar'] button#delete");
        var contParticipante = me.getController('participante.Participante');

        // Se esta eliminando un registro del grid de Estado Civil
        // pero de un participante nuevo. Solo se quita del store.
        if ( contParticipante.boolParticipanteEdit === 0 )
        {
            store.remove(record);
        }
        // Se esta eliminando un registro del grid de Estado Civil
        // pero de un participante ya creado. Si es un registro recién creado (phantom == true)
        // solo se quita del store. Si no es un registro recién creado se lo quita del store
        // y de la base de datos (sync).
        else
        {
            if ( record.phantom )
            {
                store.remove(record);
            }
            else
            {
                Ext.Msg.confirm({
                    title: 'Atención',
                    msg: '¿Esta seguro que desea eliminar esta Ocupación?. Esta acción no puede ser deshecha.',
                    icon: Ext.Msg.QUESTION,
                    buttonText: {
                        yes: 'Eliminar',
                        no: 'Cancelar'
                    },
                    fn: function(buttonId, text, opt) 
                    {
                        if (buttonId === 'yes') {
                            store.remove(record);
                        }
                    }
                });
            }
        }

        var recStore = store.getRange();
        var arrRecords = grid.getSelectionModel().getSelection();

        if ( recStore.length === 0 || arrRecords.length === 0 )
        {
            botonEdit.disable();
            botonDelete.disable();
        }
    },


    showEditWindow: function(record) {
        var me = this,
                win = me.getParticipanteOcupacionWindow(),
                isNew = record.phantom;
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('participante.edit.windowocupacion', {
                title: isNew ? 'Añadir Ocupación' : 'Editar Ocupación'
            });
        }
        // show window
        win.show();
        // load form with data
        win.down('form').loadRecord(record);
        win.doComponentLayout();
    },


    sincronizar: function() {
        var me = this,
                grid = me.getParticipanteOcupacionLista(),
                store = grid.getStore();

        store.sync();
    }
});