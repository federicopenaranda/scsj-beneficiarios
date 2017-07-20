Ext.define('sisscsj.controller.asistencia.AsistenciaBeneficiario', {
    extend: 'sisscsj.controller.Base',
    stores: [
        'asistencia.Asistencia',
        'asistencia.AsistenciaBeneficiario'
    ],
    views: [
        'asistencia.BeneficiariosLista',
        'asistencia.edit.AsistenciaForm',
        'asistencia.edit.Form',
        'asistencia.edit.Window',
        'asistencia.edit.tab.Asistencia',
        'asistencia.edit.tab.Beneficiarios'
    ],
    refs: [
        {
            ref: 'ActividadLista',
            selector: '[xtype=actividad.lista]'
        },
        {
            ref: 'AsistenciaWindow',
            selector: '[xtype=asistencia.edit.window]'
        },
        {
            ref: 'AsistenciaForm',
            selector: '[xtype=asistencia.edit.form]'
        },
        {
            ref: 'AsistenciaBeneficiariosLista',
            selector: '[xtype=asistencia.beneficiarioslista]'
        }
    ],
    init: function() {
        this.listen({
            controller: {},
            component: {
                'grid[xtype=actividad.lista] button#asistencia': {
                    //click: this.add
                },
                'grid[xtype=asistencia.beneficiarioslista]': {
                    beforerender: this.loadRecords
                },
                'window[xtype=asistencia.edit.window] button#save': {
                    //click: this.save
                },
                'window[xtype=asistencia.edit.window] button#cancel': {
                    click: this.close
                }
            },
            global: {},
            store: {},
            proxy: {}
        });
    },
    

    loadRecords: function(grid, eOpts) {
        var me = this,
                store = grid.getStore();
        
        var contAsistencia = me.getController('asistencia.Asistencia');
        
        if ( contAsistencia.boolAsistenciaEdit === 1)
        {
            var grid2 = me.getAsistenciaLista();
            var dd = grid2.getSelectionModel().getSelection();

            if ( dd.length === 1 )
            {
                var record = dd[0];
                var data = record.getData();

                store.filter( 'fk_id_asistencia', data['id_asistencia'] );
            }
        }

        store.load();
    },
            

    close: function(button, e, eOpts) {
        var me = this,
                win = button.up('window');
        // close the window
        win.close();
    },


    showEditWindow: function(record) {
        var me = this,
                win = me.getAsistenciaWindow(),
                isNew = record.phantom;
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('asistencia.edit.window', {
                title: isNew ? 'Crear Asistencia' : 'Editar Asistencia'
            });
        }
        // show window
        win.show();
        // load form with data
        win.down('form').loadRecord(record);
        win.doComponentLayout();
    },


    cancel: function(editor, context, eOpts) {
        // if the record is a phantom, remove from store and grid
        if (context.record.phantom) {
            context.store.remove(context.record);
        }
    },


    sincronizar: function() {
        var me = this,
            grid = me.getAsistenciaBeneficiariosLista(),
            store = grid.getStore();

        store.sync();
    }

});